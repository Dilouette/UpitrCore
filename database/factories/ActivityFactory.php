<?php

namespace Database\Factories;

use App\Models\Activity;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Activity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'activity_type_id' => $this->faker->numberBetween(0, 127),
            'title' => $this->faker->sentence(10),
            'start' => $this->faker->dateTime,
            'end' => $this->faker->dateTime,
            'location' => $this->faker->text(255),
            'meeting_url' => $this->faker->text(255),
            'related_to_id' => $this->faker->numberBetween(0, 127),
            'importance_id' => $this->faker->numberBetween(0, 127),
            'description' => $this->faker->sentence(15),
            'created_by' => $this->faker->randomNumber,
            'updated_by' => $this->faker->randomNumber,
            'job_id' => \App\Models\Job::factory(),
            'job_applicant_id' => \App\Models\JobApplicant::factory(),
        ];
    }
}
