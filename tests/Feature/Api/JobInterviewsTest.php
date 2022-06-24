<?php

namespace Tests\Feature\Api;

use App\Models\Job;
use App\Models\User;
use App\Models\Interview;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobInterviewsTest extends TestCase
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
    public function it_gets_job_interviews()
    {
        $job = Job::factory()->create();
        $interviews = Interview::factory()
            ->count(2)
            ->create([
                'job_id' => $job->id,
            ]);

        $response = $this->getJson(route('api.jobs.interviews.index', $job));

        $response->assertOk()->assertSee($interviews[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_job_interviews()
    {
        $job = Job::factory()->create();
        $data = Interview::factory()
            ->make([
                'job_id' => $job->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.jobs.interviews.store', $job),
            $data
        );

        $this->assertDatabaseHas('interviews', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $interview = Interview::latest('id')->first();

        $this->assertEquals($job->id, $interview->job_id);
    }
}
