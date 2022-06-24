<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\InteviewQuestion;
use Illuminate\Database\Eloquent\Factories\Factory;

class InteviewQuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InteviewQuestion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'question' => $this->faker->text,
            'title' => $this->faker->sentence(10),
            'interview_section_id' => \App\Models\InterviewSection::factory(),
        ];
    }
}
