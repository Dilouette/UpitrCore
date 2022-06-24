<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ApplicantExperience;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicantExperienceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ApplicantExperience::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(255),
            'company' => $this->faker->text(255),
            'industry_id' => $this->faker->randomNumber(0),
            'summary' => $this->faker->text,
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
            'job_applicant_id' => \App\Models\JobApplicant::factory(),
        ];
    }
}
