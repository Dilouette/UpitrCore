<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\JobSetting;

use App\Models\Job;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobSettingTest extends TestCase
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
    public function it_gets_job_settings_list()
    {
        $jobSettings = JobSetting::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.job-settings.index'));

        $response->assertOk()->assertSee($jobSettings[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_job_setting()
    {
        $data = JobSetting::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.job-settings.store'), $data);

        $this->assertDatabaseHas('job_settings', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_job_setting()
    {
        $jobSetting = JobSetting::factory()->create();

        $job = Job::factory()->create();

        $data = [
            'firstname' => 'Mandatory',
            'lastname' => 'Mandatory',
            'email' => 'Mandatory',
            'phone' => 'Mandatory',
            'heading' => 'Mandatory',
            'address' => 'Mandatory',
            'photo' => 'Mandatory',
            'education' => 'Optional',
            'experience' => 'optional',
            'summary' => 'Mandatory',
            'resume' => 'Mandatory',
            'cover_letter' => 'Mandatory',
            'cv' => 'Mandatory',
            'job_id' => $job->id,
        ];

        $response = $this->putJson(
            route('api.job-settings.update', $jobSetting),
            $data
        );

        $data['id'] = $jobSetting->id;

        $this->assertDatabaseHas('job_settings', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_job_setting()
    {
        $jobSetting = JobSetting::factory()->create();

        $response = $this->deleteJson(
            route('api.job-settings.destroy', $jobSetting)
        );

        $this->assertModelMissing($jobSetting);

        $response->assertNoContent();
    }
}
