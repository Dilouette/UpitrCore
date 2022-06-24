<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobQuestionOption;

class JobQuestionOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JobQuestionOption::factory()
            ->count(5)
            ->create();
    }
}
