<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AssesmentQuestion;

class AssesmentQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AssesmentQuestion::factory()
            ->count(5)
            ->create();
    }
}
