<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Config;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* Roles */
        $roles = [
            ['Administrator', 'api'],
            ['Partner', 'api']
        ];
        foreach($roles as $rol){
            Role::firstOrCreate(['name' => $rol[0], 'guard_name' => $rol[1]]);
        }
        /* Permisos y asignaciones */
        $permissions = Config::get('permission_list');
        foreach ($permissions as $key => $value) {
            $permissions_bonus = $value["permissions"] ?? [];
            $permissions_extra = $value["extra_permissions"] ?? [];

            $combined_permissions = array_unique(array_merge($permissions_bonus, $permissions_extra));

            $rolesAssign = $value["roles"] ?? [];

            // Determinar los guards que usan los roles asignados (si no existen, usar 'api' por defecto)
            $guards = [];
            foreach ($rolesAssign as $roleName) {
                $role = Role::where('name', $roleName)->first();
                if ($role) {
                    $guards[$role->guard_name] = $role->guard_name;
                } else {
                    $guards['api'] = 'api';
                }
            }
            if (empty($guards)) {
                $guards['api'] = 'api';
            }

            // Crear permisos por guard
            foreach ($guards as $guard) {
                Permission::firstOrCreate(['name' => $value["section"], 'guard_name' => $guard]);

                foreach ($combined_permissions as $permission) {
                    $bonus = $value["section"] . "." . $permission;
                    Permission::firstOrCreate(['name' => $bonus, 'guard_name' => $guard]);
                }
            }

            // Asignar permisos a cada rol (buscando los permisos con el guard correcto y pasando modelos)
            foreach ($rolesAssign as $roleName) {
                $role = Role::where('name', $roleName)->first();

                if ($role) {
                    $permsToAssign = [];

                    $sectionPerm = Permission::where('name', $value["section"]) ->where('guard_name', $role->guard_name)->first();
                    if ($sectionPerm) $permsToAssign[] = $sectionPerm;

                    foreach ($combined_permissions as $permission) {
                        $bonusName = $value["section"] . "." . $permission;
                        $permModel = Permission::where('name', $bonusName)->where('guard_name', $role->guard_name)->first();
                        if ($permModel) $permsToAssign[] = $permModel;
                    }

                    if (!empty($permsToAssign)) {
                        $role->givePermissionTo($permsToAssign);
                    }
                }
            }
        }

        // Limpiar caché de permisos para que los cambios sean visibles inmediatamente
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
