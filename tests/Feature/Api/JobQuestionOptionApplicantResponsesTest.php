<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\JobQuestionOption;
use App\Models\ApplicantResponse;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobQuestionOptionApplicantResponsesTest extends TestCase
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
    public function it_gets_job_question_option_applicant_responses()
    {
        $jobQuestionOption = JobQuestionOption::factory()->create();
        $applicantResponses = ApplicantResponse::factory()
            ->count(2)
            ->create([
                'job_question_option_id' => $jobQuestionOption->id,
            ]);

        $response = $this->getJson(
            route(
                'api.job-question-options.applicant-responses.index',
                $jobQuestionOption
            )
        );

        $response->assertOk()->assertSee($applicantResponses[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_job_question_option_applicant_responses()
    {
        $jobQuestionOption = JobQuestionOption::factory()->create();
        $data = ApplicantResponse::factory()
            ->make([
                'job_question_option_id' => $jobQuestionOption->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.job-question-options.applicant-responses.store',
                $jobQuestionOption
            ),
            $data
        );

        $this->assertDatabaseHas('applicant_responses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $applicantResponse = ApplicantResponse::latest('id')->first();

        $this->assertEquals(
            $jobQuestionOption->id,
            $applicantResponse->job_question_option_id
        );
    }
}
