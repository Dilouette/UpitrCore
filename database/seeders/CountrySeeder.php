<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = Storage::get("datasets/countries-nigeria.json");
        $countries = json_decode($file);

        foreach ($countries as $key => $country) {
            Country::create([
                "id" => $country->id,
                "name" => $country->name,
                "code" => $country->iso3,
                "phone_code" => $country->phone_code,
                "flag" => $country->emoji,
            ]);
        }
    }
}
