<?php

namespace Database\Seeders;

use App\Models\Region;
use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = Storage::get("datasets/departments.json");
        $departments = json_decode($file);

        foreach ($departments as $key => $dept) {
            Department::create([
                "name" => $dept,
                "description" => $dept,
                "created_by" => 1
            ]);
        }
    }
}
