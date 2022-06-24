<?php

namespace Database\Seeders;

use App\Models\Designation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = Storage::get("datasets/designations.json");
        $designations = json_decode($file);

        foreach ($designations as $key => $designation) {
            Designation::create([
                "name" => $designation,
                "description" => $designation,
                "created_by" => 1,
            ]);
        }
    }
}
