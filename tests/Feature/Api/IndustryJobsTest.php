<?php

namespace Tests\Feature\Api;

use App\Models\Job;
use App\Models\User;
use App\Models\Industry;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IndustryJobsTest extends TestCase
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
    public function it_gets_industry_jobs()
    {
        $industry = Industry::factory()->create();
        $jobs = Job::factory()
            ->count(2)
            ->create([
                'industry_id' => $industry->id,
            ]);

        $response = $this->getJson(
            route('api.industries.jobs.index', $industry)
        );

        $response->assertOk()->assertSee($jobs[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_industry_jobs()
    {
        $industry = Industry::factory()->create();
        $data = Job::factory()
            ->make([
                'industry_id' => $industry->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.industries.jobs.store', $industry),
            $data
        );

        $this->assertDatabaseHas('jobs', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $job = Job::latest('id')->first();

        $this->assertEquals($industry->id, $job->industry_id);
    }
}
