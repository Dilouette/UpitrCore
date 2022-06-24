<?php

namespace Tests\Feature\Api;

use App\Models\Job;
use App\Models\User;
use App\Models\JobSetting;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobJobSettingsTest extends TestCase
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
    public function it_gets_job_job_settings()
    {
        $job = Job::factory()->create();
        $jobSettings = JobSetting::factory()
            ->count(2)
            ->create([
                'job_id' => $job->id,
            ]);

        $response = $this->getJson(route('api.jobs.job-settings.index', $job));

        $response->assertOk()->assertSee($jobSettings[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_job_job_settings()
    {
        $job = Job::factory()->create();
        $data = JobSetting::factory()
            ->make([
                'job_id' => $job->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.jobs.job-settings.store', $job),
            $data
        );

        $this->assertDatabaseHas('job_settings', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $jobSetting = JobSetting::latest('id')->first();

        $this->assertEquals($job->id, $jobSetting->job_id);
    }
}
