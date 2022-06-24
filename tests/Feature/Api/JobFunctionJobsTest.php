<?php

namespace Tests\Feature\Api;

use App\Models\Job;
use App\Models\User;
use App\Models\JobFunction;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobFunctionJobsTest extends TestCase
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
    public function it_gets_job_function_jobs()
    {
        $jobFunction = JobFunction::factory()->create();
        $jobs = Job::factory()
            ->count(2)
            ->create([
                'job_function_id' => $jobFunction->id,
            ]);

        $response = $this->getJson(
            route('api.job-functions.jobs.index', $jobFunction)
        );

        $response->assertOk()->assertSee($jobs[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_job_function_jobs()
    {
        $jobFunction = JobFunction::factory()->create();
        $data = Job::factory()
            ->make([
                'job_function_id' => $jobFunction->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.job-functions.jobs.store', $jobFunction),
            $data
        );

        $this->assertDatabaseHas('jobs', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $job = Job::latest('id')->first();

        $this->assertEquals($jobFunction->id, $job->job_function_id);
    }
}
