<?php

namespace Database\Factories;

use App\Models\JobWorkflow;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobWorkflowFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobWorkflow::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence(15),
            'is_system_workflow' => $this->faker->boolean,
        ];
    }
}
