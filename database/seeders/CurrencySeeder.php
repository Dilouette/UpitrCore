<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = Storage::get("datasets/currencies.json");
        $currencies = json_decode($file);

        foreach ($currencies as $key => $currency) {
            Currency::create([
                "name" => $currency->name,
                "code" => $currency->cc,
            ]);
        }
    }
}
