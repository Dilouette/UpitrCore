<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\JobApplicant;
use App\Models\ApplicantEducation;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobApplicantApplicantEducationsTest extends TestCase
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
    public function it_gets_job_applicant_applicant_educations()
    {
        $jobApplicant = JobApplicant::factory()->create();
        $applicantEducations = ApplicantEducation::factory()
            ->count(2)
            ->create([
                'job_applicant_id' => $jobApplicant->id,
            ]);

        $response = $this->getJson(
            route(
                'api.job-applicants.applicant-educations.index',
                $jobApplicant
            )
        );

        $response->assertOk()->assertSee($applicantEducations[0]->institution);
    }

    /**
     * @test
     */
    public function it_stores_the_job_applicant_applicant_educations()
    {
        $jobApplicant = JobApplicant::factory()->create();
        $data = ApplicantEducation::factory()
            ->make([
                'job_applicant_id' => $jobApplicant->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.job-applicants.applicant-educations.store',
                $jobApplicant
            ),
            $data
        );

        $this->assertDatabaseHas('applicant_educations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $applicantEducation = ApplicantEducation::latest('id')->first();

        $this->assertEquals(
            $jobApplicant->id,
            $applicantEducation->job_applicant_id
        );
    }
}
