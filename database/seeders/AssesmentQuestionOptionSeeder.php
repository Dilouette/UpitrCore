<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AssesmentQuestionOption;

class AssesmentQuestionOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AssesmentQuestionOption::factory()
            ->count(5)
            ->create();
    }
}
