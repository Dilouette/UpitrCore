<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\JobQuestion;
use App\Models\QuestionType;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuestionTypeJobQuestionsTest extends TestCase
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
    public function it_gets_question_type_job_questions()
    {
        $questionType = QuestionType::factory()->create();
        $jobQuestions = JobQuestion::factory()
            ->count(2)
            ->create([
                'job_question_type_id' => $questionType->id,
            ]);

        $response = $this->getJson(
            route('api.question-types.job-questions.index', $questionType)
        );

        $response->assertOk()->assertSee($jobQuestions[0]->question);
    }

    /**
     * @test
     */
    public function it_stores_the_question_type_job_questions()
    {
        $questionType = QuestionType::factory()->create();
        $data = JobQuestion::factory()
            ->make([
                'job_question_type_id' => $questionType->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.question-types.job-questions.store', $questionType),
            $data
        );

        $this->assertDatabaseHas('job_questions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $jobQuestion = JobQuestion::latest('id')->first();

        $this->assertEquals(
            $questionType->id,
            $jobQuestion->job_question_type_id
        );
    }
}
