<?php

namespace Database\Seeders;

use App\Models\JobQuestion;
use Illuminate\Database\Seeder;

class JobQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JobQuestion::factory()
            ->count(5)
            ->create();
    }
}
