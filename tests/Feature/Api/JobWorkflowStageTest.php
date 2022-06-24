<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\JobWorkflowStage;

use App\Models\JobWorkflow;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobWorkflowStageTest extends TestCase
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
    public function it_gets_job_workflow_stages_list()
    {
        $jobWorkflowStages = JobWorkflowStage::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.job-workflow-stages.index'));

        $response->assertOk()->assertSee($jobWorkflowStages[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_job_workflow_stage()
    {
        $data = JobWorkflowStage::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.job-workflow-stages.store'),
            $data
        );

        $this->assertDatabaseHas('job_workflow_stages', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_job_workflow_stage()
    {
        $jobWorkflowStage = JobWorkflowStage::factory()->create();

        $jobWorkflow = JobWorkflow::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence(15),
            'order' => $this->faker->numberBetween(0, 127),
            'stage_type_id' => $this->faker->numberBetween(0, 127),
            'job_workflow_id' => $jobWorkflow->id,
        ];

        $response = $this->putJson(
            route('api.job-workflow-stages.update', $jobWorkflowStage),
            $data
        );

        $data['id'] = $jobWorkflowStage->id;

        $this->assertDatabaseHas('job_workflow_stages', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_job_workflow_stage()
    {
        $jobWorkflowStage = JobWorkflowStage::factory()->create();

        $response = $this->deleteJson(
            route('api.job-workflow-stages.destroy', $jobWorkflowStage)
        );

        $this->assertSoftDeleted($jobWorkflowStage);

        $response->assertNoContent();
    }
}
