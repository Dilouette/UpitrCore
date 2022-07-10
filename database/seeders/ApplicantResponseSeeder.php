<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ApplicantResponse;
use App\Models\Applicant;
use App\Models\JobQuestion;
use App\Models\JobQuestionOption;

class ApplicantResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $applicants = Applicant::all();
        foreach ($applicants as $i => $applicant) {
            $questions = JobQuestion::where('job_id', $applicant->job_id)->get();
            foreach ($questions as $j => $question) {
                if ($question->has_options) {
                    $options = JobQuestionOption::where('job_question_id', $question->id)->get()->pluck('id');
                    ApplicantResponse::factory()
                    ->create([
                        'applicant_id' => $applicant->id,
                        'job_question_id' => $question->id,
                        'response' => null,
                        'job_question_option_id' => $options[rand(1,5)],
                    ]);
                } else {
                    ApplicantResponse::factory()
                    ->create([
                        'applicant_id' => $applicant->id,
                        'job_question_id' => $question->id,
                        'job_question_option_id' => null,
                    ]);
                }              
                
            }
            
        }         
    }
}
