<?php

namespace Database\Seeders;

use App\Models\JobApplicant;
use Illuminate\Database\Seeder;

class JobApplicantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JobApplicant::factory()
            ->count(500)
            ->create();
    }
}
