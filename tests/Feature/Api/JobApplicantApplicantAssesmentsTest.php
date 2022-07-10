<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Applicant;
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
        $applicant = Applicant::factory()->create();
        $applicantAssesments = ApplicantAssesment::factory()
            ->count(2)
            ->create([
                'applicant_id' => $applicant->id,
            ]);

        $response = $this->getJson(
            route(
                'api.job-applicants.applicant-assesments.index',
                $applicant
            )
        );

        $response->assertOk()->assertSee($applicantAssesments[0]->user_agent);
    }

    /**
     * @test
     */
    public function it_stores_the_job_applicant_applicant_assesments()
    {
        $applicant = Applicant::factory()->create();
        $data = ApplicantAssesment::factory()
            ->make([
                'applicant_id' => $applicant->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.job-applicants.applicant-assesments.store',
                $applicant
            ),
            $data
        );

        $this->assertDatabaseHas('applicant_assesments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $applicantAssesment = ApplicantAssesment::latest('id')->first();

        $this->assertEquals(
            $applicant->id,
            $applicantAssesment->applicant_id
        );
    }
}
