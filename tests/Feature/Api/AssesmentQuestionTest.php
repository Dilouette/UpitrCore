<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\AssesmentQuestion;

use App\Models\Assesment;
use App\Models\QuestionType;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AssesmentQuestionTest extends TestCase
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
    public function it_gets_assesment_questions_list()
    {
        $assesmentQuestions = AssesmentQuestion::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.assesment-questions.index'));

        $response->assertOk()->assertSee($assesmentQuestions[0]->question);
    }

    /**
     * @test
     */
    public function it_stores_the_assesment_question()
    {
        $data = AssesmentQuestion::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.assesment-questions.store'),
            $data
        );

        $this->assertDatabaseHas('assesment_questions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_assesment_question()
    {
        $assesmentQuestion = AssesmentQuestion::factory()->create();

        $assesment = Assesment::factory()->create();
        $questionType = QuestionType::factory()->create();

        $data = [
            'question' => $this->faker->text,
            'answer' => $this->faker->text(255),
            'assesment_id' => $assesment->id,
            'question_type_id' => $questionType->id,
        ];

        $response = $this->putJson(
            route('api.assesment-questions.update', $assesmentQuestion),
            $data
        );

        $data['id'] = $assesmentQuestion->id;

        $this->assertDatabaseHas('assesment_questions', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_assesment_question()
    {
        $assesmentQuestion = AssesmentQuestion::factory()->create();

        $response = $this->deleteJson(
            route('api.assesment-questions.destroy', $assesmentQuestion)
        );

        $this->assertModelMissing($assesmentQuestion);

        $response->assertNoContent();
    }
}
