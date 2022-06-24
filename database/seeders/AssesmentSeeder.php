<?php

namespace Database\Seeders;

use App\Models\Assesment;
use Illuminate\Database\Seeder;

class AssesmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Assesment::factory()
            ->count(5)
            ->create();
    }
}
