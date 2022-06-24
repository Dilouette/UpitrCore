<?php

namespace Tests\Feature\Api;

use App\Models\Job;
use App\Models\User;
use App\Models\Activity;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobActivitiesTest extends TestCase
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
    public function it_gets_job_activities()
    {
        $job = Job::factory()->create();
        $activities = Activity::factory()
            ->count(2)
            ->create([
                'job_id' => $job->id,
            ]);

        $response = $this->getJson(route('api.jobs.activities.index', $job));

        $response->assertOk()->assertSee($activities[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_job_activities()
    {
        $job = Job::factory()->create();
        $data = Activity::factory()
            ->make([
                'job_id' => $job->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.jobs.activities.store', $job),
            $data
        );

        $this->assertDatabaseHas('activities', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $activity = Activity::latest('id')->first();

        $this->assertEquals($job->id, $activity->job_id);
    }
}
