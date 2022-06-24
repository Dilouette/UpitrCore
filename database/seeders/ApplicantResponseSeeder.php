<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ApplicantResponse;

class ApplicantResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ApplicantResponse::factory()
            ->count(5)
            ->create();
    }
}
