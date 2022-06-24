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
            'firstname' => $this->faker->text(255),
            'lastname' => $this->faker->lastName,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'headline' => $this->faker->text(255),
            'address' => $this->faker->text,
            'summary' => $this->faker->text,
            'resume' => $this->faker->text(255),
            'cover_letter' => $this->faker->text,
            'cv' => $this->faker->text,
            'consideration_id' => $this->faker->numberBetween(0, 127),
            'job_id' => \App\Models\Job::factory(),
            'job_workflow_stage_id' => \App\Models\JobWorkflowStage::factory(),
        ];
    }
}
