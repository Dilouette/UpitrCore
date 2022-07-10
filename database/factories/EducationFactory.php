<?php

namespace Database\Factories;

use App\Models\Candidate;
use App\Models\Education;
use Illuminate\Database\Eloquent\Factories\Factory;

class EducationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Education::class;

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
            'degree_classification_id' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
            'candidate_id' => $this->faker->randomElement(Candidate::pluck('id')->toArray()),
        ];
    }
}
