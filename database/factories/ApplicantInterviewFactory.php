<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ApplicantInterview;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicantInterviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ApplicantInterview::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'score' => $this->faker->numberBetween(0, 32767),
            'feedback' => $this->faker->text,
            'start_time' => $this->faker->dateTime,
            'end_time' => $this->faker->dateTime,
            'job_applicant_id' => \App\Models\JobApplicant::factory(),
        ];
    }
}
