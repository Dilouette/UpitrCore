<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Applicant;
use App\Models\JobWorkflowStage;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobWorkflowStageJobApplicantsTest extends TestCase
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
    public function it_gets_job_workflow_stage_applicants()
    {
        $jobWorkflowStage = JobWorkflowStage::factory()->create();
        $applicants = Applicant::factory()
            ->count(2)
            ->create([
                'job_workflow_stage_id' => $jobWorkflowStage->id,
            ]);

        $response = $this->getJson(
            route(
                'api.job-workflow-stages.job-applicants.index',
                $jobWorkflowStage
            )
        );

        $response->assertOk()->assertSee($applicants[0]->firstname);
    }

    /**
     * @test
     */
    public function it_stores_the_job_workflow_stage_applicants()
    {
        $jobWorkflowStage = JobWorkflowStage::factory()->create();
        $data = Applicant::factory()
            ->make([
                'job_workflow_stage_id' => $jobWorkflowStage->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.job-workflow-stages.job-applicants.store',
                $jobWorkflowStage
            ),
            $data
        );

        $this->assertDatabaseHas('applicants', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $applicant = Applicant::latest('id')->first();

        $this->assertEquals(
            $jobWorkflowStage->id,
            $applicant->job_workflow_stage_id
        );
    }
}
