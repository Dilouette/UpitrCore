<?php

namespace Tests\Feature\Api;

use App\Models\Job;
use App\Models\User;
use App\Models\Applicant;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobJobApplicantsTest extends TestCase
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
    public function it_gets_job_applicants()
    {
        $job = Job::factory()->create();
        $applicants = Applicant::factory()
            ->count(2)
            ->create([
                'job_id' => $job->id,
            ]);

        $response = $this->getJson(
            route('api.jobs.job-applicants.index', $job)
        );

        $response->assertOk()->assertSee($applicants[0]->firstname);
    }

    /**
     * @test
     */
    public function it_stores_the_job_applicants()
    {
        $job = Job::factory()->create();
        $data = Applicant::factory()
            ->make([
                'job_id' => $job->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.jobs.job-applicants.store', $job),
            $data
        );

        $this->assertDatabaseHas('applicants', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $applicant = Applicant::latest('id')->first();

        $this->assertEquals($job->id, $applicant->job_id);
    }
}
