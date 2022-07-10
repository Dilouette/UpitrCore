<?php

namespace Database\Factories;

use App\Models\Assesment;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssesmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Assesment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'is_timed' => $this->faker->boolean,
            'duration' => $this->faker->randomNumber(0),
            'questions_per_candidate' => $this->faker->randomNumber(0),
            'pass_score' => $this->faker->randomNumber(0),
            'job_id' => \App\Models\Job::factory(),
        ];
    }
}
