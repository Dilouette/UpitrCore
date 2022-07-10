<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Activity;
use App\Models\Applicant;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobApplicantActivitiesTest extends TestCase
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
    public function it_gets_job_applicant_activities()
    {
        $applicant = Applicant::factory()->create();
        $activities = Activity::factory()
            ->count(2)
            ->create([
                'applicant_id' => $applicant->id,
            ]);

        $response = $this->getJson(
            route('api.job-applicants.activities.index', $applicant)
        );

        $response->assertOk()->assertSee($activities[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_job_applicant_activities()
    {
        $applicant = Applicant::factory()->create();
        $data = Activity::factory()
            ->make([
                'applicant_id' => $applicant->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.job-applicants.activities.store', $applicant),
            $data
        );

        $this->assertDatabaseHas('activities', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $activity = Activity::latest('id')->first();

        $this->assertEquals($applicant->id, $activity->applicant_id);
    }
}
