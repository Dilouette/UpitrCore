<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\JobWorkflow;
use App\Models\JobWorkflowStage;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobWorkflowJobWorkflowStagesTest extends TestCase
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
    public function it_gets_job_workflow_job_workflow_stages()
    {
        $jobWorkflow = JobWorkflow::factory()->create();
        $jobWorkflowStages = JobWorkflowStage::factory()
            ->count(2)
            ->create([
                'job_workflow_id' => $jobWorkflow->id,
            ]);

        $response = $this->getJson(
            route('api.job-workflows.job-workflow-stages.index', $jobWorkflow)
        );

        $response->assertOk()->assertSee($jobWorkflowStages[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_job_workflow_job_workflow_stages()
    {
        $jobWorkflow = JobWorkflow::factory()->create();
        $data = JobWorkflowStage::factory()
            ->make([
                'job_workflow_id' => $jobWorkflow->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.job-workflows.job-workflow-stages.store', $jobWorkflow),
            $data
        );

        $this->assertDatabaseHas('job_workflow_stages', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $jobWorkflowStage = JobWorkflowStage::latest('id')->first();

        $this->assertEquals(
            $jobWorkflow->id,
            $jobWorkflowStage->job_workflow_id
        );
    }
}
