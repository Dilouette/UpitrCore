<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\AssesmentQuestion;
use App\Models\AssesmentResponse;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AssesmentQuestionAssesmentResponsesTest extends TestCase
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
    public function it_gets_assesment_question_assesment_responses()
    {
        $assesmentQuestion = AssesmentQuestion::factory()->create();
        $assesmentResponses = AssesmentResponse::factory()
            ->count(2)
            ->create([
                'assesment_question_id' => $assesmentQuestion->id,
            ]);

        $response = $this->getJson(
            route(
                'api.assesment-questions.assesment-responses.index',
                $assesmentQuestion
            )
        );

        $response->assertOk()->assertSee($assesmentResponses[0]->response);
    }

    /**
     * @test
     */
    public function it_stores_the_assesment_question_assesment_responses()
    {
        $assesmentQuestion = AssesmentQuestion::factory()->create();
        $data = AssesmentResponse::factory()
            ->make([
                'assesment_question_id' => $assesmentQuestion->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.assesment-questions.assesment-responses.store',
                $assesmentQuestion
            ),
            $data
        );

        $this->assertDatabaseHas('assesment_responses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $assesmentResponse = AssesmentResponse::latest('id')->first();

        $this->assertEquals(
            $assesmentQuestion->id,
            $assesmentResponse->assesment_question_id
        );
    }
}
