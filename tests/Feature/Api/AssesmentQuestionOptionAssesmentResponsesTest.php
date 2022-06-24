<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\AssesmentResponse;
use App\Models\AssesmentQuestionOption;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AssesmentQuestionOptionAssesmentResponsesTest extends TestCase
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
    public function it_gets_assesment_question_option_assesment_responses()
    {
        $assesmentQuestionOption = AssesmentQuestionOption::factory()->create();
        $assesmentResponses = AssesmentResponse::factory()
            ->count(2)
            ->create([
                'assesment_question_option_id' => $assesmentQuestionOption->id,
            ]);

        $response = $this->getJson(
            route(
                'api.assesment-question-options.assesment-responses.index',
                $assesmentQuestionOption
            )
        );

        $response->assertOk()->assertSee($assesmentResponses[0]->response);
    }

    /**
     * @test
     */
    public function it_stores_the_assesment_question_option_assesment_responses()
    {
        $assesmentQuestionOption = AssesmentQuestionOption::factory()->create();
        $data = AssesmentResponse::factory()
            ->make([
                'assesment_question_option_id' => $assesmentQuestionOption->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.assesment-question-options.assesment-responses.store',
                $assesmentQuestionOption
            ),
            $data
        );

        $this->assertDatabaseHas('assesment_responses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $assesmentResponse = AssesmentResponse::latest('id')->first();

        $this->assertEquals(
            $assesmentQuestionOption->id,
            $assesmentResponse->assesment_question_option_id
        );
    }
}
