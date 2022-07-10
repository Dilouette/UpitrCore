<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ApplicantAssesment;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicantAssesmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ApplicantAssesment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status_id' => $this->faker->numberBetween(0, 127),
            'score' => $this->faker->randomNumber(0),
            'start_time' => $this->faker->dateTime,
            'end_time' => $this->faker->dateTime,
            'ip' => $this->faker->ipv4,
            'user_agent' => $this->faker->userAgent,
            'applicant_id' => \App\Models\Applicant::factory(),
        ];
    }
}
