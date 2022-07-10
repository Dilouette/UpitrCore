<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ApplicantInterview;

use App\Models\Applicant;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApplicantInterviewTest extends TestCase
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
    public function it_gets_applicant_interviews_list()
    {
        $applicantInterviews = ApplicantInterview::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.applicant-interviews.index'));

        $response->assertOk()->assertSee($applicantInterviews[0]->feedback);
    }

    /**
     * @test
     */
    public function it_stores_the_applicant_interview()
    {
        $data = ApplicantInterview::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.applicant-interviews.store'),
            $data
        );

        $this->assertDatabaseHas('applicant_interviews', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_applicant_interview()
    {
        $applicantInterview = ApplicantInterview::factory()->create();

        $applicant = Applicant::factory()->create();

        $data = [
            'score' => $this->faker->numberBetween(0, 32767),
            'feedback' => $this->faker->text,
            'start_time' => $this->faker->dateTime,
            'end_time' => $this->faker->dateTime,
            'applicant_id' => $applicant->id,
        ];

        $response = $this->putJson(
            route('api.applicant-interviews.update', $applicantInterview),
            $data
        );

        $data['id'] = $applicantInterview->id;

        $this->assertDatabaseHas('applicant_interviews', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_applicant_interview()
    {
        $applicantInterview = ApplicantInterview::factory()->create();

        $response = $this->deleteJson(
            route('api.applicant-interviews.destroy', $applicantInterview)
        );

        $this->assertModelMissing($applicantInterview);

        $response->assertNoContent();
    }
}
