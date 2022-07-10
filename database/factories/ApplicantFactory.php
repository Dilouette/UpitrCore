<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\Applicant;
use App\Models\Candidate;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Applicant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cover_letter' => $this->faker->imageUrl(),
            'candidate_id' => $this->faker->randomElement(Candidate::pluck('id')->toArray()),
            'job_id' => $this->faker->randomElement(Job::pluck('id')->toArray()),
            'job_workflow_stage_id' => $this->faker->numberBetween(1, 7),
        ];
    }
}
