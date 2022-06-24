<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ApplicantAssesment;

class ApplicantAssesmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ApplicantAssesment::factory()
            ->count(5)
            ->create();
    }
}
