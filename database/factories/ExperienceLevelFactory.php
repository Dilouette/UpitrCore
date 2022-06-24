<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ExperienceLevel;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExperienceLevelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ExperienceLevel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(255),
        ];
    }
}
