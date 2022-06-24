<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ApplicantInterview;
use App\Models\ApplicantInterviewFeedback;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApplicantInterviewApplicantInterviewFeedbacksTest extends TestCase
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
    public function it_gets_applicant_interview_applicant_interview_feedbacks()
    {
        $applicantInterview = ApplicantInterview::factory()->create();
        $applicantInterviewFeedbacks = ApplicantInterviewFeedback::factory()
            ->count(2)
            ->create([
                'applicant_interview_id' => $applicantInterview->id,
            ]);

        $response = $this->getJson(
            route(
                'api.applicant-interviews.applicant-interview-feedbacks.index',
                $applicantInterview
            )
        );

        $response->assertOk()->assertSee($applicantInterviewFeedbacks[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_applicant_interview_applicant_interview_feedbacks()
    {
        $applicantInterview = ApplicantInterview::factory()->create();
        $data = ApplicantInterviewFeedback::factory()
            ->make([
                'applicant_interview_id' => $applicantInterview->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.applicant-interviews.applicant-interview-feedbacks.store',
                $applicantInterview
            ),
            $data
        );

        $this->assertDatabaseHas('applicant_interview_feedbacks', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $applicantInterviewFeedback = ApplicantInterviewFeedback::latest(
            'id'
        )->first();

        $this->assertEquals(
            $applicantInterview->id,
            $applicantInterviewFeedback->applicant_interview_id
        );
    }
}
