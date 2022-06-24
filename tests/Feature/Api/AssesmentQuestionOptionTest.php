<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\AssesmentQuestionOption;

use App\Models\AssesmentQuestion;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AssesmentQuestionOptionTest extends TestCase
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
    public function it_gets_assesment_question_options_list()
    {
        $assesmentQuestionOptions = AssesmentQuestionOption::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(
            route('api.assesment-question-options.index')
        );

        $response->assertOk()->assertSee($assesmentQuestionOptions[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_assesment_question_option()
    {
        $data = AssesmentQuestionOption::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.assesment-question-options.store'),
            $data
        );

        $this->assertDatabaseHas('assesment_question_options', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_assesment_question_option()
    {
        $assesmentQuestionOption = AssesmentQuestionOption::factory()->create();

        $assesmentQuestion = AssesmentQuestion::factory()->create();

        $data = [
            'is_answer' => $this->faker->boolean,
            'assesment_question_id' => $assesmentQuestion->id,
        ];

        $response = $this->putJson(
            route(
                'api.assesment-question-options.update',
                $assesmentQuestionOption
            ),
            $data
        );

        $data['id'] = $assesmentQuestionOption->id;

        $this->assertDatabaseHas('assesment_question_options', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_assesment_question_option()
    {
        $assesmentQuestionOption = AssesmentQuestionOption::factory()->create();

        $response = $this->deleteJson(
            route(
                'api.assesment-question-options.destroy',
                $assesmentQuestionOption
            )
        );

        $this->assertModelMissing($assesmentQuestionOption);

        $response->assertNoContent();
    }
}
