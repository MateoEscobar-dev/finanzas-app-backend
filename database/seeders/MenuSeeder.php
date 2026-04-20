<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpiar menús existentes
        Menu::truncate();

        // ============================================
        // MENÚ 1: Dashboard
        // ============================================
        Menu::create([
            'key' => 'item-dashboard',
            'label' => 'Dashboard',
            'icon' => 'mdi mdi-home',
            'link' => '/app/dashboard',
            'parent_key' => null,
            'is_title' => false,
            'collapsed' => false,
            'id_sistema_pantalla' => 0,
            'order' => 0,
            'padre_id' => 0,
            'icon_id' => 1,
            'flag_detalle' => false,
            'flag_visible' => true,
            'id_sistema' => 1,
            'bt_fecha' => now(),
        ]);

        // ============================================
        // MENÚ 2: Permissions
        // ============================================
        $permissions = Menu::create([
            'key' => 'item-permissions',
            'label' => 'Permissions',
            'icon' => 'mdi mdi-lock',
            'link' => null,
            'parent_key' => null,
            'is_title' => false,
            'collapsed' => true,
            'id_sistema_pantalla' => 100,
            'order' => 1,
            'padre_id' => 0,
            'icon_id' => 10,
            'flag_detalle' => false,
            'flag_visible' => true,
            'id_sistema' => 1,
            'bt_fecha' => now(),
        ]);

        // Submenú: Roles
        Menu::create([
            'key' => 'item-roles',
            'label' => 'Roles',
            'icon' => 'mdi mdi-shield-account',
            'link' => '/app/roles',
            'parent_key' => 'item-permissions',
            'is_title' => false,
            'collapsed' => true,
            'id_sistema_pantalla' => 101,
            'order' => 1,
            'padre_id' => 100,
            'icon_id' => 11,
            'flag_detalle' => true,
            'flag_visible' => true,
            'id_sistema' => 1,
            'parent_menu_id' => $permissions->id,
            'bt_fecha' => now(),
        ]);

        // ============================================
        // MENÚ 3: System
        // ============================================
        $system = Menu::create([
            'key' => 'item-system',
            'label' => 'System',
            'icon' => 'mdi mdi-cog',
            'link' => null,
            'parent_key' => null,
            'is_title' => false,
            'collapsed' => true,
            'id_sistema_pantalla' => 200,
            'order' => 2,
            'padre_id' => 0,
            'icon_id' => 20,
            'flag_detalle' => false,
            'flag_visible' => true,
            'id_sistema' => 1,
            'bt_fecha' => now(),
        ]);

        // Submenú: Configuration
        $configuration = Menu::create([
            'key' => 'item-configuration',
            'label' => 'Configuration',
            'icon' => 'mdi mdi-settings',
            'link' => null,
            'parent_key' => 'item-system',
            'is_title' => false,
            'collapsed' => true,
            'id_sistema_pantalla' => 201,
            'order' => 1,
            'padre_id' => 200,
            'icon_id' => 21,
            'flag_detalle' => false,
            'flag_visible' => true,
            'id_sistema' => 1,
            'parent_menu_id' => $system->id,
            'bt_fecha' => now(),
        ]);

        // Sub-submenú: Users
        Menu::create([
            'key' => 'item-users',
            'label' => 'Users',
            'icon' => 'mdi mdi-account-multiple',
            'link' => '/app/users',
            'parent_key' => 'item-configuration',
            'is_title' => false,
            'collapsed' => true,
            'id_sistema_pantalla' => 202,
            'order' => 1,
            'padre_id' => 201,
            'icon_id' => 22,
            'flag_detalle' => true,
            'flag_visible' => true,
            'id_sistema' => 1,
            'parent_menu_id' => $configuration->id,
            'bt_fecha' => now(),
        ]);

        // ============================================
        // MENÚ 4: Orquestation
        // ============================================
        $orchestration = Menu::create([
            'key' => 'item-orchestration',
            'label' => 'Orquestation',
            'icon' => 'mdi mdi-console',
            'link' => null,
            'parent_key' => null,
            'is_title' => false,
            'collapsed' => true,
            'id_sistema_pantalla' => 300,
            'order' => 4,
            'padre_id' => 0,
            'icon_id' => 10,
            'flag_detalle' => false,
            'flag_visible' => true,
            'id_sistema' => 1,
            'bt_fecha' => now(),
        ]);

        // Submenú: Servers
        Menu::create([
            'key' => 'item-servers',
            'label' => 'Servers',
            'icon' => 'mdi mdi-server',
            'link' => '/app/servers',
            'parent_key' => 'item-orchestration',
            'is_title' => false,
            'collapsed' => true,
            'id_sistema_pantalla' => 301,
            'order' => 1,
            'padre_id' => 300,
            'icon_id' => 11,
            'flag_detalle' => true,
            'flag_visible' => true,
            'id_sistema' => 1,
            'parent_menu_id' => $orchestration->id,
            'bt_fecha' => now(),
        ]);
    }
}


