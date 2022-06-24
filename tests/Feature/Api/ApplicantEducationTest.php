<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ApplicantEducation;

use App\Models\JobApplicant;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApplicantEducationTest extends TestCase
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
    public function it_gets_applicant_educations_list()
    {
        $applicantEducations = ApplicantEducation::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.applicant-educations.index'));

        $response->assertOk()->assertSee($applicantEducations[0]->institution);
    }

    /**
     * @test
     */
    public function it_stores_the_applicant_education()
    {
        $data = ApplicantEducation::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.applicant-educations.store'),
            $data
        );

        $this->assertDatabaseHas('applicant_educations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_applicant_education()
    {
        $applicantEducation = ApplicantEducation::factory()->create();

        $jobApplicant = JobApplicant::factory()->create();

        $data = [
            'institution' => $this->faker->text(255),
            'field' => $this->faker->text(255),
            'degree' => $this->faker->text(255),
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
            'job_applicant_id' => $jobApplicant->id,
        ];

        $response = $this->putJson(
            route('api.applicant-educations.update', $applicantEducation),
            $data
        );

        $data['id'] = $applicantEducation->id;

        $this->assertDatabaseHas('applicant_educations', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_applicant_education()
    {
        $applicantEducation = ApplicantEducation::factory()->create();

        $response = $this->deleteJson(
            route('api.applicant-educations.destroy', $applicantEducation)
        );

        $this->assertModelMissing($applicantEducation);

        $response->assertNoContent();
    }
}
