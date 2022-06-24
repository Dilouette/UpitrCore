<?php

namespace Database\Seeders;

use App\Models\PermissionGroup;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PermissionGroup::create(['name' => 'applicants','description' => 'applicants']);
        PermissionGroup::create(['name' => 'vacancies','description' => 'vacancies']);
        PermissionGroup::create(['name' => 'department','description' => 'department']);
        PermissionGroup::create(['name' => 'reports','description' => 'reports']);
        PermissionGroup::create(['name' => 'roles','description' => 'roles']);
        PermissionGroup::create(['name' => 'users','description' => 'users']);
        PermissionGroup::create(['name' => 'settings','description' => 'settings']);
    }
}
