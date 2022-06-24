<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\QuestionType;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuestionTypeTest extends TestCase
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
    public function it_gets_question_types_list()
    {
        $questionTypes = QuestionType::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.question-types.index'));

        $response->assertOk()->assertSee($questionTypes[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_question_type()
    {
        $data = QuestionType::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.question-types.store'), $data);

        $this->assertDatabaseHas('question_types', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_question_type()
    {
        $questionType = QuestionType::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence(15),
        ];

        $response = $this->putJson(
            route('api.question-types.update', $questionType),
            $data
        );

        $data['id'] = $questionType->id;

        $this->assertDatabaseHas('question_types', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_question_type()
    {
        $questionType = QuestionType::factory()->create();

        $response = $this->deleteJson(
            route('api.question-types.destroy', $questionType)
        );

        $this->assertModelMissing($questionType);

        $response->assertNoContent();
    }
}
