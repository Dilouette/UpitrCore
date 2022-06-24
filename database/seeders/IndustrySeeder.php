<?php

namespace Database\Seeders;

use App\Models\Industry;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class IndustrySeeder extends Seeder
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
            Industry::create([
                "name" => $item,
            ]);
        }
    }
}
