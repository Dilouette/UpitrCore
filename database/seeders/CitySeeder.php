<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = Storage::get("datasets/cities-nigeria.json");
        $cities = json_decode($file);

        foreach ($cities as $key => $city) {
            City::create([
                "id" => $city->id,
                "name" => $city->name,
                "region_id" => $city->state_id
            ]);
        }
    }
}
