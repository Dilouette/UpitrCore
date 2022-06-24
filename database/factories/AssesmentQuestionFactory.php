<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\AssesmentQuestion;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssesmentQuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AssesmentQuestion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'question' => $this->faker->text,
            'answer' => $this->faker->text(255),
            'assesment_id' => \App\Models\Assesment::factory(),
            'question_type_id' => \App\Models\QuestionType::factory(),
        ];
    }
}
