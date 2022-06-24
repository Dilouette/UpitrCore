<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\InterviewSection;
use Illuminate\Database\Eloquent\Factories\Factory;

class InterviewSectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InterviewSection::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(10),
            'description' => $this->faker->sentence(15),
            'interview_id' => \App\Models\Interview::factory(),
        ];
    }
}
