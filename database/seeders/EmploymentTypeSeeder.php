<?php

namespace Database\Seeders;

use App\Models\EmploymentType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class EmploymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = Storage::get("datasets/employment-types.json");
        $items = json_decode($file);

        foreach ($items as $key => $item) {
            EmploymentType::create([
                "name" => $item
            ]);
        }
    }
}
