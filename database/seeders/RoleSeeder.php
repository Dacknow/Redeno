<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    
        // truncar sin errores
        Permission::truncate();
        Role::truncate();
        DB::table('role_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('model_has_permissions')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Crear roles
        $role1 = Role::create(['name' => 'Administrador', 'guard_name' => 'admin']);
        $role2 = Role::create(['name' => 'Coordinador', 'guard_name' => 'admin']);
        $role3 = Role::create(['name' => 'Supervisor', 'guard_name' => 'admin']);
        $role4 = Role::create(['name' => 'Veedor Instalaciones', 'guard_name' => 'admin']);
        $role5 = Role::create(['name' => 'Veedor Reparaciones', 'guard_name' => 'admin']);
        $role6 = Role::create(['name' => 'Veedor Escaleras', 'guard_name' => 'admin']);

        // Crear permisos y asignarlos a roles
        Permission::create(['name' => 'dashboard', 'guard_name' => 'admin'])->syncRoles([$role1, $role2, $role3, $role4, $role5, $role6]);

        Permission::create(['name' => 'users', 'guard_name' => 'admin'])->syncRoles([$role1, $role2]);       
        Permission::create(['name' => 'users.create-technician', 'guard_name' => 'admin'])->syncRoles([$role1, $role2]); 
        Permission::create(['name' => 'users.edit-technician', 'guard_name' => 'admin'])->syncRoles([$role1, $role2]); 
        Permission::create(['name' => 'users.destroy-technician', 'guard_name' => 'admin'])->syncRoles([$role1, $role2]);        
        Permission::create(['name' => 'users.create-admin', 'guard_name' => 'admin'])->syncRoles([$role1, $role2]); 
        Permission::create(['name' => 'users.edit-admin', 'guard_name' => 'admin'])->syncRoles([$role1, $role2]); 
        Permission::create(['name' => 'users.destroy-admin', 'guard_name' => 'admin'])->syncRoles([$role1, $role2]); 

        Permission::create(['name' => 'templates-page', 'guard_name' => 'admin'])->syncRoles([$role1, $role2]); 

        Permission::create(['name' => 'manage-reports', 'guard_name' => 'admin'])->syncRoles([$role1, $role2, $role3, $role4, $role5, $role6]); 

        Permission::create(['name' => 'roles', 'guard_name' => 'admin'])->syncRoles([$role1, $role2]);   
        Permission::create(['name' => 'roles.create', 'guard_name' => 'admin'])->syncRoles([$role1, $role2]); 
        Permission::create(['name' => 'roles.edit', 'guard_name' => 'admin'])->syncRoles([$role1, $role2]); 
        Permission::create(['name' => 'roles.destroy', 'guard_name' => 'admin'])->syncRoles([$role1, $role2]);

        

        $admin1 = Admin::find(1); // Coordinador
        $admin2 = Admin::find(2); // Administrador
        $admin3 = Admin::find(3); // Supervisor
        $admin4 = Admin::find(4); // Supervisor
        $admin5 = Admin::find(5); // Supervisor
        $admin6 = Admin::find(6); // Supervisor
        $admin7 = Admin::find(7); // Veedor Instalaciones
        $admin8 = Admin::find(8); // Veedor Reparaciones
        $admin9 = Admin::find(9); // Veedor Escaleras

        $admin1?->assignRole('Coordinador');
        $admin2?->assignRole('Administrador');
        $admin3?->assignRole('Supervisor');
        $admin4?->assignRole('Supervisor');
        $admin5?->assignRole('Supervisor');
        $admin6?->assignRole('Supervisor');
        $admin7?->assignRole('Veedor Instalaciones');
        $admin8?->assignRole('Veedor Reparaciones');
        $admin9?->assignRole('Veedor Escaleras');

    }
}


