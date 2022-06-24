<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\JobApplicant;
use App\Models\ApplicantResponse;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobApplicantApplicantResponsesTest extends TestCase
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
    public function it_gets_job_applicant_applicant_responses()
    {
        $jobApplicant = JobApplicant::factory()->create();
        $applicantResponses = ApplicantResponse::factory()
            ->count(2)
            ->create([
                'job_applicant_id' => $jobApplicant->id,
            ]);

        $response = $this->getJson(
            route('api.job-applicants.applicant-responses.index', $jobApplicant)
        );

        $response->assertOk()->assertSee($applicantResponses[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_job_applicant_applicant_responses()
    {
        $jobApplicant = JobApplicant::factory()->create();
        $data = ApplicantResponse::factory()
            ->make([
                'job_applicant_id' => $jobApplicant->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.job-applicants.applicant-responses.store',
                $jobApplicant
            ),
            $data
        );

        $this->assertDatabaseHas('applicant_responses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $applicantResponse = ApplicantResponse::latest('id')->first();

        $this->assertEquals(
            $jobApplicant->id,
            $applicantResponse->job_applicant_id
        );
    }
}
