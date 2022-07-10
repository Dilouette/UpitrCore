<?php

namespace Database\Factories;

use App\Models\Interview;
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
            'score' => $this->faker->numberBetween(5, 25),
            'feedback' => $this->faker->text,
            'start_time' => $this->faker->dateTime,
            'end_time' => $this->faker->dateTime,
            'applicant_id' => \App\Models\Applicant::factory(),
            'interview_id' => Interview::factory(),
            'created_by' => \App\Models\User::factory(),
        ];
    }
}
