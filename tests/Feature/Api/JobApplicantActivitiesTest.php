<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Activity;
use App\Models\JobApplicant;

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
        $jobApplicant = JobApplicant::factory()->create();
        $activities = Activity::factory()
            ->count(2)
            ->create([
                'job_applicant_id' => $jobApplicant->id,
            ]);

        $response = $this->getJson(
            route('api.job-applicants.activities.index', $jobApplicant)
        );

        $response->assertOk()->assertSee($activities[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_job_applicant_activities()
    {
        $jobApplicant = JobApplicant::factory()->create();
        $data = Activity::factory()
            ->make([
                'job_applicant_id' => $jobApplicant->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.job-applicants.activities.store', $jobApplicant),
            $data
        );

        $this->assertDatabaseHas('activities', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $activity = Activity::latest('id')->first();

        $this->assertEquals($jobApplicant->id, $activity->job_applicant_id);
    }
}
