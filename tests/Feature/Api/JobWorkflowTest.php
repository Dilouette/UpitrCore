<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\JobWorkflow;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobWorkflowTest extends TestCase
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
    public function it_gets_job_workflows_list()
    {
        $jobWorkflows = JobWorkflow::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.job-workflows.index'));

        $response->assertOk()->assertSee($jobWorkflows[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_job_workflow()
    {
        $data = JobWorkflow::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.job-workflows.store'), $data);

        $this->assertDatabaseHas('job_workflows', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_job_workflow()
    {
        $jobWorkflow = JobWorkflow::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence(15),
            'is_system_workflow' => $this->faker->boolean,
        ];

        $response = $this->putJson(
            route('api.job-workflows.update', $jobWorkflow),
            $data
        );

        $data['id'] = $jobWorkflow->id;

        $this->assertDatabaseHas('job_workflows', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_job_workflow()
    {
        $jobWorkflow = JobWorkflow::factory()->create();

        $response = $this->deleteJson(
            route('api.job-workflows.destroy', $jobWorkflow)
        );

        $this->assertSoftDeleted($jobWorkflow);

        $response->assertNoContent();
    }
}
