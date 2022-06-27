<?php

namespace Database\Factories;

use App\Models\Job;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Job::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(10),
            'code' => $this->faker->unique->text(16),
            'zip_code' => $this->faker->address(),
            'location' => $this->faker->text(255),
            'is_remote' => $this->faker->boolean,
            'description' => $this->faker->text,
            'requirements' => $this->faker->text,
            'benefit' => $this->faker->text,
            'keywords' => "MS Excel, ACCA, Dynamics, ICAN",
            'salary_min' => $this->faker->randomNumber(200000),
            'salary_max' => $this->faker->randomNumber(300000),
            'head_count' => $this->faker->numberBetween(0, 10),
            'created_by' => 1,
            'is_published' => $this->faker->boolean,
            'deadline' => $this->faker->dateTimeBetween($startDate = 'now', $endDate = '+1 month'),
            'department_id' => 1,
            'salary_currency_id' => 1,
            'industry_id' => 1,
            'job_function_id' => 1,
            'employment_type_id' => 1,
            'experience_level_id' => 1,
            'education_level_id' => 1,
            'country_id' => 161,
            'region_id' => 303,
            'city_id' => 76744,
            'job_workflow_id' => 1,
        ];
    }
}
