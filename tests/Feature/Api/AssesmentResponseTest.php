<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\AssesmentResponse;

use App\Models\AssesmentQuestion;
use App\Models\ApplicantAssesment;
use App\Models\AssesmentQuestionOption;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AssesmentResponseTest extends TestCase
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
    public function it_gets_assesment_responses_list()
    {
        $assesmentResponses = AssesmentResponse::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.assesment-responses.index'));

        $response->assertOk()->assertSee($assesmentResponses[0]->response);
    }

    /**
     * @test
     */
    public function it_stores_the_assesment_response()
    {
        $data = AssesmentResponse::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.assesment-responses.store'),
            $data
        );

        $this->assertDatabaseHas('assesment_responses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_assesment_response()
    {
        $assesmentResponse = AssesmentResponse::factory()->create();

        $applicantAssesment = ApplicantAssesment::factory()->create();
        $assesmentQuestion = AssesmentQuestion::factory()->create();
        $assesmentQuestionOption = AssesmentQuestionOption::factory()->create();

        $data = [
            'response' => $this->faker->text(255),
            'applicant_assesment_id' => $applicantAssesment->id,
            'assesment_question_id' => $assesmentQuestion->id,
            'assesment_question_option_id' => $assesmentQuestionOption->id,
        ];

        $response = $this->putJson(
            route('api.assesment-responses.update', $assesmentResponse),
            $data
        );

        $data['id'] = $assesmentResponse->id;

        $this->assertDatabaseHas('assesment_responses', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_assesment_response()
    {
        $assesmentResponse = AssesmentResponse::factory()->create();

        $response = $this->deleteJson(
            route('api.assesment-responses.destroy', $assesmentResponse)
        );

        $this->assertModelMissing($assesmentResponse);

        $response->assertNoContent();
    }
}
