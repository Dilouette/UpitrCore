<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Applicant;
use App\Models\ApplicantInterview;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobApplicantApplicantInterviewsTest extends TestCase
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
    public function it_gets_job_applicant_applicant_interviews()
    {
        $applicant = Applicant::factory()->create();
        $applicantInterviews = ApplicantInterview::factory()
            ->count(2)
            ->create([
                'applicant_id' => $applicant->id,
            ]);

        $response = $this->getJson(
            route(
                'api.job-applicants.applicant-interviews.index',
                $applicant
            )
        );

        $response->assertOk()->assertSee($applicantInterviews[0]->feedback);
    }

    /**
     * @test
     */
    public function it_stores_the_job_applicant_applicant_interviews()
    {
        $applicant = Applicant::factory()->create();
        $data = ApplicantInterview::factory()
            ->make([
                'applicant_id' => $applicant->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.job-applicants.applicant-interviews.store',
                $applicant
            ),
            $data
        );

        $this->assertDatabaseHas('applicant_interviews', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $applicantInterview = ApplicantInterview::latest('id')->first();

        $this->assertEquals(
            $applicant->id,
            $applicantInterview->applicant_id
        );
    }
}
