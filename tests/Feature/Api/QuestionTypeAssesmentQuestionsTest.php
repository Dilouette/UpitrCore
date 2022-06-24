<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\QuestionType;
use App\Models\AssesmentQuestion;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuestionTypeAssesmentQuestionsTest extends TestCase
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
    public function it_gets_question_type_assesment_questions()
    {
        $questionType = QuestionType::factory()->create();
        $assesmentQuestions = AssesmentQuestion::factory()
            ->count(2)
            ->create([
                'question_type_id' => $questionType->id,
            ]);

        $response = $this->getJson(
            route('api.question-types.assesment-questions.index', $questionType)
        );

        $response->assertOk()->assertSee($assesmentQuestions[0]->question);
    }

    /**
     * @test
     */
    public function it_stores_the_question_type_assesment_questions()
    {
        $questionType = QuestionType::factory()->create();
        $data = AssesmentQuestion::factory()
            ->make([
                'question_type_id' => $questionType->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.question-types.assesment-questions.store',
                $questionType
            ),
            $data
        );

        $this->assertDatabaseHas('assesment_questions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $assesmentQuestion = AssesmentQuestion::latest('id')->first();

        $this->assertEquals(
            $questionType->id,
            $assesmentQuestion->question_type_id
        );
    }
}
