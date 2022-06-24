<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\JobApplicant;
use App\Models\ApplicantExperience;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobApplicantApplicantExperiencesTest extends TestCase
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
    public function it_gets_job_applicant_applicant_experiences()
    {
        $jobApplicant = JobApplicant::factory()->create();
        $applicantExperiences = ApplicantExperience::factory()
            ->count(2)
            ->create([
                'job_applicant_id' => $jobApplicant->id,
            ]);

        $response = $this->getJson(
            route(
                'api.job-applicants.applicant-experiences.index',
                $jobApplicant
            )
        );

        $response->assertOk()->assertSee($applicantExperiences[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_job_applicant_applicant_experiences()
    {
        $jobApplicant = JobApplicant::factory()->create();
        $data = ApplicantExperience::factory()
            ->make([
                'job_applicant_id' => $jobApplicant->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.job-applicants.applicant-experiences.store',
                $jobApplicant
            ),
            $data
        );

        $this->assertDatabaseHas('applicant_experiences', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $applicantExperience = ApplicantExperience::latest('id')->first();

        $this->assertEquals(
            $jobApplicant->id,
            $applicantExperience->job_applicant_id
        );
    }
}
