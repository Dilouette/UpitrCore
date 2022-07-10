<?php

namespace Database\Factories;

use App\Models\Note;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Note::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(10),
            'content' => $this->faker->text,
            'related_to_id' => $this->faker->numberBetween(0, 127),
            'created_by' => $this->faker->randomNumber,
            'updated_by' => $this->faker->randomNumber,
            'job_id' => \App\Models\Job::factory(),
            'applicant_id' => \App\Models\Applicant::factory(),
        ];
    }
}
