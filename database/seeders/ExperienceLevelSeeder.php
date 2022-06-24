<?php

namespace Database\Seeders;

use App\Models\ExperienceLevel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ExperienceLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = Storage::get("datasets/experiences.json");
        $items = json_decode($file);

        foreach ($items as $key => $item) {
            ExperienceLevel::create([
                "name" => $item,
            ]);
        }
    }
}
