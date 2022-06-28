<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ApplicantEducation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicantEducationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ApplicantEducation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'institution' => $this->faker->company(),
            'field' => $this->faker->jobTitle(),
            'degree' => $this->faker->text(64),
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
            'job_applicant_id' => \App\Models\JobApplicant::factory(),
        ];
    }
}
