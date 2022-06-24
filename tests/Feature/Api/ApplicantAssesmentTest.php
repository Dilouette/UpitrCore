<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ApplicantAssesment;

use App\Models\JobApplicant;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApplicantAssesmentTest extends TestCase
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
    public function it_gets_applicant_assesments_list()
    {
        $applicantAssesments = ApplicantAssesment::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.applicant-assesments.index'));

        $response->assertOk()->assertSee($applicantAssesments[0]->user_agent);
    }

    /**
     * @test
     */
    public function it_stores_the_applicant_assesment()
    {
        $data = ApplicantAssesment::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.applicant-assesments.store'),
            $data
        );

        $this->assertDatabaseHas('applicant_assesments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_applicant_assesment()
    {
        $applicantAssesment = ApplicantAssesment::factory()->create();

        $jobApplicant = JobApplicant::factory()->create();

        $data = [
            'status_id' => $this->faker->numberBetween(0, 127),
            'score' => $this->faker->randomNumber(0),
            'start_time' => $this->faker->dateTime,
            'end_time' => $this->faker->dateTime,
            'ip' => $this->faker->ipv4,
            'user_agent' => $this->faker->userAgent,
            'job_applicant_id' => $jobApplicant->id,
        ];

        $response = $this->putJson(
            route('api.applicant-assesments.update', $applicantAssesment),
            $data
        );

        $data['id'] = $applicantAssesment->id;

        $this->assertDatabaseHas('applicant_assesments', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_applicant_assesment()
    {
        $applicantAssesment = ApplicantAssesment::factory()->create();

        $response = $this->deleteJson(
            route('api.applicant-assesments.destroy', $applicantAssesment)
        );

        $this->assertModelMissing($applicantAssesment);

        $response->assertNoContent();
    }
}
