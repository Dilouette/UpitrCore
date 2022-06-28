<?php

namespace Database\Seeders;

use App\Models\JobQuestion;
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
        $questions = JobQuestion::all();
        foreach ($questions as $key => $question) {
            if ($question->has_options == true) {                
                JobQuestionOption::factory()
                ->count(5)
                ->create([
                    'job_question_id' => $question->id
                ]);
            }
        }
    }
}
