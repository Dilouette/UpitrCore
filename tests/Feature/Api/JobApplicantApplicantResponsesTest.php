<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Applicant;
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
        $applicant = Applicant::factory()->create();
        $applicantResponses = ApplicantResponse::factory()
            ->count(2)
            ->create([
                'applicant_id' => $applicant->id,
            ]);

        $response = $this->getJson(
            route('api.job-applicants.applicant-responses.index', $applicant)
        );

        $response->assertOk()->assertSee($applicantResponses[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_job_applicant_applicant_responses()
    {
        $applicant = Applicant::factory()->create();
        $data = ApplicantResponse::factory()
            ->make([
                'applicant_id' => $applicant->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.job-applicants.applicant-responses.store',
                $applicant
            ),
            $data
        );

        $this->assertDatabaseHas('applicant_responses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $applicantResponse = ApplicantResponse::latest('id')->first();

        $this->assertEquals(
            $applicant->id,
            $applicantResponse->applicant_id
        );
    }
}
