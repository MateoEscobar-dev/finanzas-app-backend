<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

/**
 * Seeder de usuario de prueba para QA — DCI-8
 *
 * Credenciales:
 *   Email:    qa@finanzas.test
 *   Password: Test@1234  (se encripta en AES desde Angular antes de enviarse)
 */
class QaTestUserSeeder extends Seeder
{
    public function run(): void
    {
        $qaUser = User::firstOrCreate(
            ['email' => 'qa@finanzas.test'],
            [
                'document'        => '9999999999',
                'first_name'      => 'QA',
                'second_name'     => null,
                'first_last_name' => 'Tester',
                'second_last_name'=> null,
                'email'           => 'qa@finanzas.test',
                'password'        => Hash::make('Test@1234'),
                'phone'           => '+570000000000',
                'phone_ext'       => null,
                'birth_day'       => '1990-01-01',
                'lang'            => 'es',
                'active'          => 1,
            ]
        );

        // Asignar rol base de usuario si existe
        $role = Role::where('name', 'User')->orWhere('name', 'Administrator')->first();
        if ($role && !$qaUser->hasRole($role->name)) {
            $qaUser->assignRole($role);
        }

        $this->command->info("Usuario QA creado: qa@finanzas.test / Test@1234");
    }
}
