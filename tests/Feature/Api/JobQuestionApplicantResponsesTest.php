<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\JobQuestion;
use App\Models\ApplicantResponse;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobQuestionApplicantResponsesTest extends TestCase
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
    public function it_gets_job_question_applicant_responses()
    {
        $jobQuestion = JobQuestion::factory()->create();
        $applicantResponses = ApplicantResponse::factory()
            ->count(2)
            ->create([
                'job_question_id' => $jobQuestion->id,
            ]);

        $response = $this->getJson(
            route('api.job-questions.applicant-responses.index', $jobQuestion)
        );

        $response->assertOk()->assertSee($applicantResponses[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_job_question_applicant_responses()
    {
        $jobQuestion = JobQuestion::factory()->create();
        $data = ApplicantResponse::factory()
            ->make([
                'job_question_id' => $jobQuestion->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.job-questions.applicant-responses.store', $jobQuestion),
            $data
        );

        $this->assertDatabaseHas('applicant_responses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $applicantResponse = ApplicantResponse::latest('id')->first();

        $this->assertEquals(
            $jobQuestion->id,
            $applicantResponse->job_question_id
        );
    }
}
