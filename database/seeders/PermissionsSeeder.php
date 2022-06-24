<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['group_id' => 1, 'name' => 'list_applicants']);
        Permission::create(['group_id' => 1, 'name' => 'view_applicants']);
        Permission::create(['group_id' => 1, 'name' => 'create_applicants']);
        Permission::create(['group_id' => 1, 'name' => 'update_applicants']);
        Permission::create(['group_id' => 1, 'name' => 'delete_applicants']);

        Permission::create(['group_id' => 2, 'name' => 'list_vacancies']);
        Permission::create(['group_id' => 2, 'name' => 'view_vacancies']);
        Permission::create(['group_id' => 2, 'name' => 'create_vacancies']);
        Permission::create(['group_id' => 2, 'name' => 'update_vacancies']);
        Permission::create(['group_id' => 2, 'name' => 'delete_vacancies']);

        Permission::create(['group_id' => 3, 'name' => 'list_departments']);
        Permission::create(['group_id' => 3, 'name' => 'view_departments']);
        Permission::create(['group_id' => 3, 'name' => 'create_departments']);
        Permission::create(['group_id' => 3, 'name' => 'update_departments']);
        Permission::create(['group_id' => 3, 'name' => 'delete_departments']);

        Permission::create(['group_id' => 4, 'name' => 'vacancy_reports']);
        Permission::create(['group_id' => 4, 'name' => 'applicant_reports']);

        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        Permission::create(['group_id' => 5, 'name' => 'list_roles']);
        Permission::create(['group_id' => 5, 'name' => 'view_roles']);
        Permission::create(['group_id' => 5, 'name' => 'create_roles']);
        Permission::create(['group_id' => 5, 'name' => 'update_roles']);
        Permission::create(['group_id' => 5, 'name' => 'delete_roles']);

        Permission::create(['group_id' => 6, 'name' => 'list_users']);
        Permission::create(['group_id' => 6, 'name' => 'view_users']);
        Permission::create(['group_id' => 6, 'name' => 'create_users']);
        Permission::create(['group_id' => 6, 'name' => 'update_users']);
        Permission::create(['group_id' => 6, 'name' => 'delete_users']);

        Permission::create(['group_id' => 7, 'name' => 'update_company']);

        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::factory()
        ->count(1)
        ->create([
            'email' => 'optimus@upitr.com',
            'is_active'=> true,
            'password' => Hash::make('password@123'),
        ]);

        $user = \App\Models\User::whereEmail('optimus@upitr.com')->first();

        if ($user) {
             $user->assignRole($adminRole);
        }
    }
}
