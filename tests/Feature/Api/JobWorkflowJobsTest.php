<?php

namespace Tests\Feature\Api;

use App\Models\Job;
use App\Models\User;
use App\Models\JobWorkflow;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobWorkflowJobsTest extends TestCase
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
    public function it_gets_job_workflow_jobs()
    {
        $jobWorkflow = JobWorkflow::factory()->create();
        $jobs = Job::factory()
            ->count(2)
            ->create([
                'job_workflow_id' => $jobWorkflow->id,
            ]);

        $response = $this->getJson(
            route('api.job-workflows.jobs.index', $jobWorkflow)
        );

        $response->assertOk()->assertSee($jobs[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_job_workflow_jobs()
    {
        $jobWorkflow = JobWorkflow::factory()->create();
        $data = Job::factory()
            ->make([
                'job_workflow_id' => $jobWorkflow->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.job-workflows.jobs.store', $jobWorkflow),
            $data
        );

        $this->assertDatabaseHas('jobs', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $job = Job::latest('id')->first();

        $this->assertEquals($jobWorkflow->id, $job->job_workflow_id);
    }
}
