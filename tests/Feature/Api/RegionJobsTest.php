<?php

namespace Tests\Feature\Api;

use App\Models\Job;
use App\Models\User;
use App\Models\Region;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegionJobsTest extends TestCase
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
    public function it_gets_region_jobs()
    {
        $region = Region::factory()->create();
        $jobs = Job::factory()
            ->count(2)
            ->create([
                'region_id' => $region->id,
            ]);

        $response = $this->getJson(route('api.regions.jobs.index', $region));

        $response->assertOk()->assertSee($jobs[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_region_jobs()
    {
        $region = Region::factory()->create();
        $data = Job::factory()
            ->make([
                'region_id' => $region->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.regions.jobs.store', $region),
            $data
        );

        $this->assertDatabaseHas('jobs', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $job = Job::latest('id')->first();

        $this->assertEquals($region->id, $job->region_id);
    }
}
