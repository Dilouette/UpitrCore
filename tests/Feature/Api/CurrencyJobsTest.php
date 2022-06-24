<?php

namespace Tests\Feature\Api;

use App\Models\Job;
use App\Models\User;
use App\Models\Currency;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CurrencyJobsTest extends TestCase
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
    public function it_gets_currency_jobs()
    {
        $currency = Currency::factory()->create();
        $jobs = Job::factory()
            ->count(2)
            ->create([
                'salary_currency_id' => $currency->id,
            ]);

        $response = $this->getJson(
            route('api.currencies.jobs.index', $currency)
        );

        $response->assertOk()->assertSee($jobs[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_currency_jobs()
    {
        $currency = Currency::factory()->create();
        $data = Job::factory()
            ->make([
                'salary_currency_id' => $currency->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.currencies.jobs.store', $currency),
            $data
        );

        $this->assertDatabaseHas('jobs', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $job = Job::latest('id')->first();

        $this->assertEquals($currency->id, $job->salary_currency_id);
    }
}
