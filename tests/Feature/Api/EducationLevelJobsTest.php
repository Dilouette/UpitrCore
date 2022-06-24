<?php

namespace Tests\Feature\Api;

use App\Models\Job;
use App\Models\User;
use App\Models\EducationLevel;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EducationLevelJobsTest extends TestCase
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
    public function it_gets_education_level_jobs()
    {
        $educationLevel = EducationLevel::factory()->create();
        $jobs = Job::factory()
            ->count(2)
            ->create([
                'education_level_id' => $educationLevel->id,
            ]);

        $response = $this->getJson(
            route('api.education-levels.jobs.index', $educationLevel)
        );

        $response->assertOk()->assertSee($jobs[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_education_level_jobs()
    {
        $educationLevel = EducationLevel::factory()->create();
        $data = Job::factory()
            ->make([
                'education_level_id' => $educationLevel->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.education-levels.jobs.store', $educationLevel),
            $data
        );

        $this->assertDatabaseHas('jobs', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $job = Job::latest('id')->first();

        $this->assertEquals($educationLevel->id, $job->education_level_id);
    }
}
