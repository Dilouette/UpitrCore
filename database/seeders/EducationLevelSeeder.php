<?php

namespace Database\Seeders;

use App\Models\EducationLevel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class EducationLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = Storage::get("datasets/education.json");
        $items = json_decode($file);

        foreach ($items as $key => $item) {
            EducationLevel::create([
                "name" => $item,
            ]);
        }
    }
}
