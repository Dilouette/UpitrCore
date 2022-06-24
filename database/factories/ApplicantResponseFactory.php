<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ApplicantResponse;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicantResponseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ApplicantResponse::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'job_applicant_id' => \App\Models\JobApplicant::factory(),
            'job_question_id' => \App\Models\JobQuestion::factory(),
            'job_question_option_id' => \App\Models\JobQuestionOption::factory(),
        ];
    }
}
