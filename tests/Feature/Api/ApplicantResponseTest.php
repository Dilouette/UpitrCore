<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ApplicantResponse;

use App\Models\JobQuestion;
use App\Models\Applicant;
use App\Models\JobQuestionOption;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApplicantResponseTest extends TestCase
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
    public function it_gets_applicant_responses_list()
    {
        $applicantResponses = ApplicantResponse::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.applicant-responses.index'));

        $response->assertOk()->assertSee($applicantResponses[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_applicant_response()
    {
        $data = ApplicantResponse::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.applicant-responses.store'),
            $data
        );

        $this->assertDatabaseHas('applicant_responses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_applicant_response()
    {
        $applicantResponse = ApplicantResponse::factory()->create();

        $applicant = Applicant::factory()->create();
        $jobQuestion = JobQuestion::factory()->create();
        $jobQuestionOption = JobQuestionOption::factory()->create();

        $data = [
            'applicant_id' => $applicant->id,
            'job_question_id' => $jobQuestion->id,
            'job_question_option_id' => $jobQuestionOption->id,
        ];

        $response = $this->putJson(
            route('api.applicant-responses.update', $applicantResponse),
            $data
        );

        $data['id'] = $applicantResponse->id;

        $this->assertDatabaseHas('applicant_responses', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_applicant_response()
    {
        $applicantResponse = ApplicantResponse::factory()->create();

        $response = $this->deleteJson(
            route('api.applicant-responses.destroy', $applicantResponse)
        );

        $this->assertModelMissing($applicantResponse);

        $response->assertNoContent();
    }
}
