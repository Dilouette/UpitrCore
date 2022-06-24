<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\InteviewQuestion;
use App\Models\ApplicantInterviewFeedback;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InteviewQuestionApplicantInterviewFeedbacksTest extends TestCase
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
    public function it_gets_inteview_question_applicant_interview_feedbacks()
    {
        $inteviewQuestion = InteviewQuestion::factory()->create();
        $applicantInterviewFeedbacks = ApplicantInterviewFeedback::factory()
            ->count(2)
            ->create([
                'inteview_question_id' => $inteviewQuestion->id,
            ]);

        $response = $this->getJson(
            route(
                'api.inteview-questions.applicant-interview-feedbacks.index',
                $inteviewQuestion
            )
        );

        $response->assertOk()->assertSee($applicantInterviewFeedbacks[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_inteview_question_applicant_interview_feedbacks()
    {
        $inteviewQuestion = InteviewQuestion::factory()->create();
        $data = ApplicantInterviewFeedback::factory()
            ->make([
                'inteview_question_id' => $inteviewQuestion->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.inteview-questions.applicant-interview-feedbacks.store',
                $inteviewQuestion
            ),
            $data
        );

        $this->assertDatabaseHas('applicant_interview_feedbacks', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $applicantInterviewFeedback = ApplicantInterviewFeedback::latest(
            'id'
        )->first();

        $this->assertEquals(
            $inteviewQuestion->id,
            $applicantInterviewFeedback->inteview_question_id
        );
    }
}
