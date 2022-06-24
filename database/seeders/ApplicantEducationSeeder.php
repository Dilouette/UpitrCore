<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ApplicantEducation;

class ApplicantEducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ApplicantEducation::factory()
            ->count(5)
            ->create();
    }
}
