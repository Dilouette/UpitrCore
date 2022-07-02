<?php

namespace Database\Factories;

use App\Models\Interview;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class InterviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Interview::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(5),
            'type_id' => $this->faker->numberBetween(0, 127),
            'job_id' => \App\Models\Job::factory(),
        ];
    }
}
