<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ApplicantInterviewFeedback;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicantInterviewFeedbackFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ApplicantInterviewFeedback::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'rating' => $this->faker->numberBetween(1, 5),
            'applicant_interview_id' => \App\Models\ApplicantInterview::factory(),
            'interview_section_id' => \App\Models\InterviewSection::factory(),
        ];
    }
}
