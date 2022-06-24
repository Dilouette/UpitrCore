<?php

namespace Tests\Feature\Api;

use App\Models\Job;
use App\Models\User;
use App\Models\Country;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CountryJobsTest extends TestCase
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
    public function it_gets_country_jobs()
    {
        $country = Country::factory()->create();
        $jobs = Job::factory()
            ->count(2)
            ->create([
                'country_id' => $country->id,
            ]);

        $response = $this->getJson(route('api.countries.jobs.index', $country));

        $response->assertOk()->assertSee($jobs[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_country_jobs()
    {
        $country = Country::factory()->create();
        $data = Job::factory()
            ->make([
                'country_id' => $country->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.countries.jobs.store', $country),
            $data
        );

        $this->assertDatabaseHas('jobs', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $job = Job::latest('id')->first();

        $this->assertEquals($country->id, $job->country_id);
    }
}
