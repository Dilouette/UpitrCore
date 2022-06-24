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
            'code' => $this->faker->unique->text(255),
            'zip_code' => $this->faker->text(255),
            'location' => $this->faker->text(255),
            'is_remote' => $this->faker->boolean,
            'description' => $this->faker->text,
            'requirements' => $this->faker->text,
            'benefit' => $this->faker->text,
            'keywords' => $this->faker->text,
            'salary_min' => $this->faker->randomNumber(2),
            'salary_max' => $this->faker->randomNumber(2),
            'head_count' => $this->faker->numberBetween(0, 32767),
            'created_by' => $this->faker->randomNumber,
            'is_published' => $this->faker->boolean,
            'deadline' => $this->faker->dateTime,
            'department_id' => \App\Models\Department::factory(),
            'salary_currency_id' => \App\Models\Currency::factory(),
            'industry_id' => \App\Models\Industry::factory(),
            'job_function_id' => \App\Models\JobFunction::factory(),
            'employment_type_id' => \App\Models\EmploymentType::factory(),
            'experience_level_id' => \App\Models\ExperienceLevel::factory(),
            'education_level_id' => \App\Models\EducationLevel::factory(),
            'country_id' => \App\Models\Country::factory(),
            'region_id' => \App\Models\Region::factory(),
            'city_id' => \App\Models\City::factory(),
            'job_workflow_id' => \App\Models\JobWorkflow::factory(),
        ];
    }
}
