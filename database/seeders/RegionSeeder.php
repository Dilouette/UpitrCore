<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = Storage::get("datasets/states-nigeria.json");
        $states = json_decode($file);

        foreach ($states as $key => $state) {
            Region::create([
                "id" => $state->id,
                "name" => $state->name,
                "country_id" => $state->country_id
            ]);
        }
    }
}
