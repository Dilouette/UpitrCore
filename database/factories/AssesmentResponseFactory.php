<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\AssesmentResponse;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssesmentResponseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AssesmentResponse::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'response' => $this->faker->text(255),
            'applicant_assesment_id' => \App\Models\ApplicantAssesment::factory(),
            'assesment_question_id' => \App\Models\AssesmentQuestion::factory(),
            'assesment_question_option_id' => \App\Models\AssesmentQuestionOption::factory(),
        ];
    }
}
