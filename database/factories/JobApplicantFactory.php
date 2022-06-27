<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\JobApplicant;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobApplicantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobApplicant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'email' => $this->faker->email,
            'dob' => $this->faker->dateTimeBetween($startDate='-30 years', $endDate='-20 years'),
            'gender_id' => $this->faker->randomElement(0, 1),
            'phone' => $this->faker->phoneNumber,
            'headline' => $this->faker->text(128),
            'address' => $this->faker->text,
            'summary' => $this->faker->text,
            'resume' => $this->faker->imageUrl(),
            'cover_letter' => $this->faker->imageUrl(),
            'skills' => $this->faker->text,
            'consideration_id' => $this->faker->numberBetween(0, 2),
            'job_id' => $this->faker->numberBetween(0, 20),
            'job_workflow_stage_id' => $this->faker->numberBetween(0, 5),
        ];
    }
}
