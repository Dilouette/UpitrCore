<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Experience;

use App\Models\Applicant;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApplicantExperienceTest extends TestCase
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
    public function it_gets_applicant_experiences_list()
    {
        $applicantExperiences = Experience::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.applicant-experiences.index'));

        $response->assertOk()->assertSee($applicantExperiences[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_applicant_experience()
    {
        $data = Experience::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.applicant-experiences.store'),
            $data
        );

        $this->assertDatabaseHas('applicant_experiences', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_applicant_experience()
    {
        $applicantExperience = Experience::factory()->create();

        $applicant = Applicant::factory()->create();

        $data = [
            'title' => $this->faker->text(255),
            'company' => $this->faker->text(255),
            'industry_id' => $this->faker->randomNumber(0),
            'summary' => $this->faker->text,
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
            'applicant_id' => $applicant->id,
        ];

        $response = $this->putJson(
            route('api.applicant-experiences.update', $applicantExperience),
            $data
        );

        $data['id'] = $applicantExperience->id;

        $this->assertDatabaseHas('applicant_experiences', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_applicant_experience()
    {
        $applicantExperience = Experience::factory()->create();

        $response = $this->deleteJson(
            route('api.applicant-experiences.destroy', $applicantExperience)
        );

        $this->assertModelMissing($applicantExperience);

        $response->assertNoContent();
    }
}
