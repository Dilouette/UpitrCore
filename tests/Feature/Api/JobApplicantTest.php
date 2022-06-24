<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\JobApplicant;

use App\Models\Job;
use App\Models\JobWorkflowStage;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobApplicantTest extends TestCase
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
    public function it_gets_job_applicants_list()
    {
        $jobApplicants = JobApplicant::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.job-applicants.index'));

        $response->assertOk()->assertSee($jobApplicants[0]->firstname);
    }

    /**
     * @test
     */
    public function it_stores_the_job_applicant()
    {
        $data = JobApplicant::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.job-applicants.store'), $data);

        $this->assertDatabaseHas('job_applicants', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_job_applicant()
    {
        $jobApplicant = JobApplicant::factory()->create();

        $job = Job::factory()->create();
        $jobWorkflowStage = JobWorkflowStage::factory()->create();

        $data = [
            'job_id' => $this->faker->randomNumber(0),
            'firstname' => $this->faker->text(255),
            'lastname' => $this->faker->lastName,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'headline' => $this->faker->text(255),
            'address' => $this->faker->text,
            'summary' => $this->faker->text,
            'resume' => $this->faker->text(255),
            'cover_letter' => $this->faker->text,
            'cv' => $this->faker->text,
            'consideration_id' => $this->faker->numberBetween(0, 127),
            'job_id' => $job->id,
            'job_workflow_stage_id' => $jobWorkflowStage->id,
        ];

        $response = $this->putJson(
            route('api.job-applicants.update', $jobApplicant),
            $data
        );

        $data['id'] = $jobApplicant->id;

        $this->assertDatabaseHas('job_applicants', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_job_applicant()
    {
        $jobApplicant = JobApplicant::factory()->create();

        $response = $this->deleteJson(
            route('api.job-applicants.destroy', $jobApplicant)
        );

        $this->assertModelMissing($jobApplicant);

        $response->assertNoContent();
    }
}
