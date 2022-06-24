<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\AssesmentQuestion;
use App\Models\AssesmentQuestionOption;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AssesmentQuestionAssesmentQuestionOptionsTest extends TestCase
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
    public function it_gets_assesment_question_assesment_question_options()
    {
        $assesmentQuestion = AssesmentQuestion::factory()->create();
        $assesmentQuestionOptions = AssesmentQuestionOption::factory()
            ->count(2)
            ->create([
                'assesment_question_id' => $assesmentQuestion->id,
            ]);

        $response = $this->getJson(
            route(
                'api.assesment-questions.assesment-question-options.index',
                $assesmentQuestion
            )
        );

        $response->assertOk()->assertSee($assesmentQuestionOptions[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_assesment_question_assesment_question_options()
    {
        $assesmentQuestion = AssesmentQuestion::factory()->create();
        $data = AssesmentQuestionOption::factory()
            ->make([
                'assesment_question_id' => $assesmentQuestion->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.assesment-questions.assesment-question-options.store',
                $assesmentQuestion
            ),
            $data
        );

        $this->assertDatabaseHas('assesment_question_options', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $assesmentQuestionOption = AssesmentQuestionOption::latest(
            'id'
        )->first();

        $this->assertEquals(
            $assesmentQuestion->id,
            $assesmentQuestionOption->assesment_question_id
        );
    }
}
