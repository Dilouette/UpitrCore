<?php

namespace Tests\Feature\Api;

use App\Models\Job;
use App\Models\User;
use App\Models\EmploymentType;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmploymentTypeJobsTest extends TestCase
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
    public function it_gets_employment_type_jobs()
    {
        $employmentType = EmploymentType::factory()->create();
        $jobs = Job::factory()
            ->count(2)
            ->create([
                'employment_type_id' => $employmentType->id,
            ]);

        $response = $this->getJson(
            route('api.employment-types.jobs.index', $employmentType)
        );

        $response->assertOk()->assertSee($jobs[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_employment_type_jobs()
    {
        $employmentType = EmploymentType::factory()->create();
        $data = Job::factory()
            ->make([
                'employment_type_id' => $employmentType->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.employment-types.jobs.store', $employmentType),
            $data
        );

        $this->assertDatabaseHas('jobs', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $job = Job::latest('id')->first();

        $this->assertEquals($employmentType->id, $job->employment_type_id);
    }
}
