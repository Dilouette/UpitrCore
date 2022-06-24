<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ApplicantInterviewFeedback;

use App\Models\InteviewQuestion;
use App\Models\ApplicantInterview;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApplicantInterviewFeedbackTest extends TestCase
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
    public function it_gets_applicant_interview_feedbacks_list()
    {
        $applicantInterviewFeedbacks = ApplicantInterviewFeedback::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(
            route('api.applicant-interview-feedbacks.index')
        );

        $response->assertOk()->assertSee($applicantInterviewFeedbacks[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_applicant_interview_feedback()
    {
        $data = ApplicantInterviewFeedback::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.applicant-interview-feedbacks.store'),
            $data
        );

        $this->assertDatabaseHas('applicant_interview_feedbacks', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_applicant_interview_feedback()
    {
        $applicantInterviewFeedback = ApplicantInterviewFeedback::factory()->create();

        $applicantInterview = ApplicantInterview::factory()->create();
        $inteviewQuestion = InteviewQuestion::factory()->create();

        $data = [
            'rating' => $this->faker->numberBetween(0, 127),
            'applicant_interview_id' => $applicantInterview->id,
            'inteview_question_id' => $inteviewQuestion->id,
        ];

        $response = $this->putJson(
            route(
                'api.applicant-interview-feedbacks.update',
                $applicantInterviewFeedback
            ),
            $data
        );

        $data['id'] = $applicantInterviewFeedback->id;

        $this->assertDatabaseHas('applicant_interview_feedbacks', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_applicant_interview_feedback()
    {
        $applicantInterviewFeedback = ApplicantInterviewFeedback::factory()->create();

        $response = $this->deleteJson(
            route(
                'api.applicant-interview-feedbacks.destroy',
                $applicantInterviewFeedback
            )
        );

        $this->assertModelMissing($applicantInterviewFeedback);

        $response->assertNoContent();
    }
}
