<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\JobQuestionOption;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobQuestionOptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobQuestionOption::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'option' => $this->faker->text(255),
            'job_question_id' => \App\Models\JobQuestion::factory(),
        ];
    }
}
