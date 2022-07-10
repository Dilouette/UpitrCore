<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Applicant;
use App\Models\Education;

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
        $applicant = Applicant::factory()->create();
        $applicantEducations = Education::factory()
            ->count(2)
            ->create([
                'applicant_id' => $applicant->id,
            ]);

        $response = $this->getJson(
            route(
                'api.job-applicants.applicant-educations.index',
                $applicant
            )
        );

        $response->assertOk()->assertSee($applicantEducations[0]->institution);
    }

    /**
     * @test
     */
    public function it_stores_the_job_applicant_applicant_educations()
    {
        $applicant = Applicant::factory()->create();
        $data = Education::factory()
            ->make([
                'applicant_id' => $applicant->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.job-applicants.applicant-educations.store',
                $applicant
            ),
            $data
        );

        $this->assertDatabaseHas('applicant_educations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $applicantEducation = Education::latest('id')->first();

        $this->assertEquals(
            $applicant->id,
            $applicantEducation->applicant_id
        );
    }
}
