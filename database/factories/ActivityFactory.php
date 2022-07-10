<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\User;
use App\Models\Activity;
use Illuminate\Support\Str;
use App\Models\Applicant;
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
            'activity_type_id' => $this->faker->numberBetween(0, 4),
            'title' => $this->faker->sentence(5),
            'start' => $this->faker->dateTime,
            'end' => $this->faker->dateTime,
            'location' => $this->faker->streetAddress(),
            'meeting_url' => $this->faker->url(),
            'related_to_id' => $this->faker->numberBetween(0, 1),
            'importance_id' => $this->faker->numberBetween(0, 2),
            'status_id' => $this->faker->numberBetween(0, 3),
            'description' => $this->faker->sentence(10),
            'created_by' => $this->faker->randomElement(User::pluck('id')->toArray()),
            'updated_by' => $this->faker->randomElement(User::pluck('id')->toArray()),
            'job_id' => $this->faker->randomElement(Job::pluck('id')->toArray()),
            'applicant_id' => $this->faker->randomElement(Applicant::pluck('id')->toArray()),
        ];
    }
}
