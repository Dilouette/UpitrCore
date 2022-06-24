<?php

namespace Tests\Feature\Api;

use App\Models\Job;
use App\Models\User;
use App\Models\ExperienceLevel;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExperienceLevelJobsTest extends TestCase
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
    public function it_gets_experience_level_jobs()
    {
        $experienceLevel = ExperienceLevel::factory()->create();
        $jobs = Job::factory()
            ->count(2)
            ->create([
                'experience_level_id' => $experienceLevel->id,
            ]);

        $response = $this->getJson(
            route('api.experience-levels.jobs.index', $experienceLevel)
        );

        $response->assertOk()->assertSee($jobs[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_experience_level_jobs()
    {
        $experienceLevel = ExperienceLevel::factory()->create();
        $data = Job::factory()
            ->make([
                'experience_level_id' => $experienceLevel->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.experience-levels.jobs.store', $experienceLevel),
            $data
        );

        $this->assertDatabaseHas('jobs', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $job = Job::latest('id')->first();

        $this->assertEquals($experienceLevel->id, $job->experience_level_id);
    }
}
