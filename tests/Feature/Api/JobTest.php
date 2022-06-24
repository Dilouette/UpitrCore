<?php

namespace Tests\Feature\Api;

use App\Models\Job;
use App\Models\User;

use App\Models\City;
use App\Models\Region;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Industry;
use App\Models\Department;
use App\Models\JobFunction;
use App\Models\JobWorkflow;
use App\Models\EmploymentType;
use App\Models\EducationLevel;
use App\Models\ExperienceLevel;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_jobs_list()
    {
        $jobs = Job::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.jobs.index'));

        $response->assertOk()->assertSee($jobs[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_job()
    {
        $data = Job::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.jobs.store'), $data);

        $this->assertDatabaseHas('jobs', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_job()
    {
        $job = Job::factory()->create();

        $department = Department::factory()->create();
        $currency = Currency::factory()->create();
        $industry = Industry::factory()->create();
        $jobFunction = JobFunction::factory()->create();
        $employmentType = EmploymentType::factory()->create();
        $experienceLevel = ExperienceLevel::factory()->create();
        $educationLevel = EducationLevel::factory()->create();
        $country = Country::factory()->create();
        $region = Region::factory()->create();
        $city = City::factory()->create();
        $jobWorkflow = JobWorkflow::factory()->create();

        $data = [
            'title' => $this->faker->sentence(10),
            'code' => $this->faker->unique->text(255),
            'country_id' => $this->faker->randomNumber(0),
            'region_id' => $this->faker->randomNumber(0),
            'city_id' => $this->faker->randomNumber(0),
            'zip_code' => $this->faker->text(255),
            'location' => $this->faker->text(255),
            'is_remote' => $this->faker->boolean,
            'description' => $this->faker->text,
            'requirements' => $this->faker->text,
            'benefit' => $this->faker->text,
            'industry_id' => $this->faker->randomNumber(0),
            'job_function_id' => $this->faker->randomNumber(0),
            'employment_type_id' => $this->faker->randomNumber(0),
            'experience_level_id' => $this->faker->randomNumber(0),
            'education_level_id' => $this->faker->randomNumber(0),
            'keywords' => $this->faker->text,
            'salary_min' => $this->faker->randomNumber(2),
            'salary_max' => $this->faker->randomNumber(2),
            'salary_currency_id' => $this->faker->randomNumber(0),
            'head_count' => $this->faker->numberBetween(0, 32767),
            'created_by' => $this->faker->randomNumber,
            'is_published' => $this->faker->boolean,
            'deadline' => $this->faker->dateTime,
            'department_id' => $department->id,
            'salary_currency_id' => $currency->id,
            'industry_id' => $industry->id,
            'job_function_id' => $jobFunction->id,
            'employment_type_id' => $employmentType->id,
            'experience_level_id' => $experienceLevel->id,
            'education_level_id' => $educationLevel->id,
            'country_id' => $country->id,
            'region_id' => $region->id,
            'city_id' => $city->id,
            'job_workflow_id' => $jobWorkflow->id,
        ];

        $response = $this->putJson(route('api.jobs.update', $job), $data);

        $data['id'] = $job->id;

        $this->assertDatabaseHas('jobs', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_job()
    {
        $job = Job::factory()->create();

        $response = $this->deleteJson(route('api.jobs.destroy', $job));

        $this->assertSoftDeleted($job);

        $response->assertNoContent();
    }
}
