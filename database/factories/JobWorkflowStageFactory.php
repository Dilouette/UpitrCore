<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\JobWorkflowStage;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobWorkflowStageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobWorkflowStage::class;

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
            'order' => $this->faker->numberBetween(0, 127),
            'stage_type_id' => $this->faker->numberBetween(0, 127),
            'job_workflow_id' => \App\Models\JobWorkflow::factory(),
        ];
    }
}
