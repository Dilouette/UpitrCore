<?php

namespace Database\Seeders;

use App\Models\Applicant;
use App\Models\Interview;
use Illuminate\Database\Seeder;
use App\Models\InterviewSection;
use App\Models\ApplicantInterview;
use Illuminate\Support\Facades\Log;
use App\Models\ApplicantInterviewFeedback;

class ApplicantInterviewFeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $interviews = ApplicantInterview::where('applicant_id', 1)->get();        
        foreach ($interviews as $key => $interview) {
            $sections = InterviewSection::where('interview_id', $interview->interview_id)->get();
            foreach ($sections as $key => $section) {
                ApplicantInterviewFeedback::factory()
                ->create([
                    'applicant_interview_id' => $interview->id,
                    'interview_section_id' => $section->id,
                ]);
            }
        }        
       
    }
}
