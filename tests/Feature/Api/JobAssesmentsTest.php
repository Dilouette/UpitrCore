<?php

namespace Tests\Feature\Api;

use App\Models\Job;
use App\Models\User;
use App\Models\Assesment;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobAssesmentsTest extends TestCase
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
    public function it_gets_job_assesments()
    {
        $job = Job::factory()->create();
        $assesments = Assesment::factory()
            ->count(2)
            ->create([
                'job_id' => $job->id,
            ]);

        $response = $this->getJson(route('api.jobs.assesments.index', $job));

        $response->assertOk()->assertSee($assesments[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_job_assesments()
    {
        $job = Job::factory()->create();
        $data = Assesment::factory()
            ->make([
                'job_id' => $job->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.jobs.assesments.store', $job),
            $data
        );

        $this->assertDatabaseHas('assesments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $assesment = Assesment::latest('id')->first();

        $this->assertEquals($job->id, $assesment->job_id);
    }
}
