<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\AssesmentQuestionOption;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssesmentQuestionOptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AssesmentQuestionOption::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'value' => $this->faker->text(16),
            'is_answer' => $this->faker->boolean,
            'assesment_question_id' => \App\Models\AssesmentQuestion::factory(),
        ];
    }
}
