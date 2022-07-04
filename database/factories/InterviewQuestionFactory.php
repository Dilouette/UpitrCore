<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\InterviewQuestion;
use Illuminate\Database\Eloquent\Factories\Factory;

class InterviewQuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InterviewQuestion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'question' => $this->faker->sentence(10),
            'title' => $this->faker->sentence(5),
            'interview_section_id' => \App\Models\InterviewSection::factory(),
        ];
    }
}
