<?php

namespace Database\Seeders;

use App\Models\Interview;
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
        $interviews = Interview::all();
        foreach ($interviews as $i => $interview) {
            InterviewSection::factory()
            ->count(5)
            ->create([
                'interview_id' => $interview->id,
            ]);
        }
        
    }
}
