<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Applicant;
use App\Models\Experience;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobApplicantApplicantExperiencesTest extends TestCase
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
    public function it_gets_job_applicant_applicant_experiences()
    {
        $applicant = Applicant::factory()->create();
        $applicantExperiences = Experience::factory()
            ->count(2)
            ->create([
                'applicant_id' => $applicant->id,
            ]);

        $response = $this->getJson(
            route(
                'api.job-applicants.applicant-experiences.index',
                $applicant
            )
        );

        $response->assertOk()->assertSee($applicantExperiences[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_job_applicant_applicant_experiences()
    {
        $applicant = Applicant::factory()->create();
        $data = Experience::factory()
            ->make([
                'applicant_id' => $applicant->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.job-applicants.applicant-experiences.store',
                $applicant
            ),
            $data
        );

        $this->assertDatabaseHas('applicant_experiences', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $applicantExperience = Experience::latest('id')->first();

        $this->assertEquals(
            $applicant->id,
            $applicantExperience->applicant_id
        );
    }
}
