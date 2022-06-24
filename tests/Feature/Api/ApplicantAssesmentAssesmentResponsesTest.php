<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\AssesmentResponse;
use App\Models\ApplicantAssesment;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApplicantAssesmentAssesmentResponsesTest extends TestCase
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
    public function it_gets_applicant_assesment_assesment_responses()
    {
        $applicantAssesment = ApplicantAssesment::factory()->create();
        $assesmentResponses = AssesmentResponse::factory()
            ->count(2)
            ->create([
                'applicant_assesment_id' => $applicantAssesment->id,
            ]);

        $response = $this->getJson(
            route(
                'api.applicant-assesments.assesment-responses.index',
                $applicantAssesment
            )
        );

        $response->assertOk()->assertSee($assesmentResponses[0]->response);
    }

    /**
     * @test
     */
    public function it_stores_the_applicant_assesment_assesment_responses()
    {
        $applicantAssesment = ApplicantAssesment::factory()->create();
        $data = AssesmentResponse::factory()
            ->make([
                'applicant_assesment_id' => $applicantAssesment->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.applicant-assesments.assesment-responses.store',
                $applicantAssesment
            ),
            $data
        );

        $this->assertDatabaseHas('assesment_responses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $assesmentResponse = AssesmentResponse::latest('id')->first();

        $this->assertEquals(
            $applicantAssesment->id,
            $assesmentResponse->applicant_assesment_id
        );
    }
}
