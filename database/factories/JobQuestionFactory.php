<?php

namespace Database\Factories;

use App\Models\JobQuestion;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobQuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobQuestion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'question' => $this->faker->text,
            'job_id' => \App\Models\Job::factory(),
            'job_question_type_id' => \App\Models\QuestionType::factory(),
        ];
    }
}
