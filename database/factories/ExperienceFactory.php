<?php

namespace Database\Factories;

use App\Models\Industry;
use App\Models\Candidate;
use App\Models\Experience;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExperienceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Experience::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->jobTitle(),
            'company' => $this->faker->company(),
            'industry_id' => $this->faker->randomElement(Industry::pluck('id')->toArray()),
            'summary' => $this->faker->text(128),
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
            'candidate_id' => $this->faker->randomElement(Candidate::pluck('id')->toArray()),
        ];
    }
}
