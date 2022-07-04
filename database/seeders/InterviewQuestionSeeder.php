<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InterviewSection;
use App\Models\InterviewQuestion;

class InterviewQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sections = InterviewSection::all();
        foreach ($sections as $i => $section) {
            InterviewQuestion::factory()
            ->count(5)
            ->create([
                'interview_section_id' => $section->id,
            ]);
        }
        
    }
}
