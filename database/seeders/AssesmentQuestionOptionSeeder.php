<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AssesmentQuestion;
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
        $questions = AssesmentQuestion::all();
        
        foreach ($questions as $i => $question) { 
            AssesmentQuestionOption::factory()
            ->count(5)
            ->create([
                'assesment_question_id' => $question->id,
                'is_answer' => ($i+1) % 5 == 0 ? true : false,
            ]);
        }        
    }
}
