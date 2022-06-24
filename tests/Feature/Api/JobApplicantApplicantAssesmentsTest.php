<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\JobApplicant;
use App\Models\ApplicantAssesment;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobApplicantApplicantAssesmentsTest extends TestCase
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
    public function it_gets_job_applicant_applicant_assesments()
    {
        $jobApplicant = JobApplicant::factory()->create();
        $applicantAssesments = ApplicantAssesment::factory()
            ->count(2)
            ->create([
                'job_applicant_id' => $jobApplicant->id,
            ]);

        $response = $this->getJson(
            route(
                'api.job-applicants.applicant-assesments.index',
                $jobApplicant
            )
        );

        $response->assertOk()->assertSee($applicantAssesments[0]->user_agent);
    }

    /**
     * @test
     */
    public function it_stores_the_job_applicant_applicant_assesments()
    {
        $jobApplicant = JobApplicant::factory()->create();
        $data = ApplicantAssesment::factory()
            ->make([
                'job_applicant_id' => $jobApplicant->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.job-applicants.applicant-assesments.store',
                $jobApplicant
            ),
            $data
        );

        $this->assertDatabaseHas('applicant_assesments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $applicantAssesment = ApplicantAssesment::latest('id')->first();

        $this->assertEquals(
            $jobApplicant->id,
            $applicantAssesment->job_applicant_id
        );
    }
}
