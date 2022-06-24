<?php

namespace Database\Seeders;

use App\Models\JobFunction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class JobFunctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JobFunction::factory()
            ->count(5)
            ->create();

        $file = Storage::get("datasets/job-functions.json");
        $items = json_decode($file);

        foreach ($items as $key => $item) {
            JobFunction::create([
                "name" => $item,
            ]);
        }
    }
}
