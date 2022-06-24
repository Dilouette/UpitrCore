<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Assesment;
use App\Models\AssesmentQuestion;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AssesmentAssesmentQuestionsTest extends TestCase
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
    public function it_gets_assesment_assesment_questions()
    {
        $assesment = Assesment::factory()->create();
        $assesmentQuestions = AssesmentQuestion::factory()
            ->count(2)
            ->create([
                'assesment_id' => $assesment->id,
            ]);

        $response = $this->getJson(
            route('api.assesments.assesment-questions.index', $assesment)
        );

        $response->assertOk()->assertSee($assesmentQuestions[0]->question);
    }

    /**
     * @test
     */
    public function it_stores_the_assesment_assesment_questions()
    {
        $assesment = Assesment::factory()->create();
        $data = AssesmentQuestion::factory()
            ->make([
                'assesment_id' => $assesment->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.assesments.assesment-questions.store', $assesment),
            $data
        );

        $this->assertDatabaseHas('assesment_questions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $assesmentQuestion = AssesmentQuestion::latest('id')->first();

        $this->assertEquals($assesment->id, $assesmentQuestion->assesment_id);
    }
}
