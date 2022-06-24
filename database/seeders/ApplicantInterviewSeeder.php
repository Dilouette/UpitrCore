<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ApplicantInterview;

class ApplicantInterviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ApplicantInterview::factory()
            ->count(5)
            ->create();
    }
}
