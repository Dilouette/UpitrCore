<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InterviewSection;

class InterviewSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InterviewSection::factory()
            ->count(5)
            ->create();
    }
}
