<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Activity;

use App\Models\Job;
use App\Models\JobApplicant;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityTest extends TestCase
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
    public function it_gets_activities_list()
    {
        $activities = Activity::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.activities.index'));

        $response->assertOk()->assertSee($activities[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_activity()
    {
        $data = Activity::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.activities.store'), $data);

        $this->assertDatabaseHas('activities', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_activity()
    {
        $activity = Activity::factory()->create();

        $job = Job::factory()->create();
        $jobApplicant = JobApplicant::factory()->create();

        $data = [
            'activity_type_id' => $this->faker->numberBetween(0, 127),
            'title' => $this->faker->sentence(10),
            'start' => $this->faker->dateTime,
            'end' => $this->faker->dateTime,
            'location' => $this->faker->text(255),
            'meeting_url' => $this->faker->text(255),
            'related_to_id' => $this->faker->numberBetween(0, 127),
            'importance_id' => $this->faker->numberBetween(0, 127),
            'description' => $this->faker->sentence(15),
            'created_by' => $this->faker->randomNumber,
            'updated_by' => $this->faker->randomNumber,
            'job_id' => $job->id,
            'job_applicant_id' => $jobApplicant->id,
        ];

        $response = $this->putJson(
            route('api.activities.update', $activity),
            $data
        );

        $data['id'] = $activity->id;

        $this->assertDatabaseHas('activities', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_activity()
    {
        $activity = Activity::factory()->create();

        $response = $this->deleteJson(
            route('api.activities.destroy', $activity)
        );

        $this->assertModelMissing($activity);

        $response->assertNoContent();
    }
}
