<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Assesment;

use App\Models\Job;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AssesmentTest extends TestCase
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
    public function it_gets_assesments_list()
    {
        $assesments = Assesment::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.assesments.index'));

        $response->assertOk()->assertSee($assesments[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_assesment()
    {
        $data = Assesment::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.assesments.store'), $data);

        $this->assertDatabaseHas('assesments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_assesment()
    {
        $assesment = Assesment::factory()->create();

        $job = Job::factory()->create();

        $data = [
            'is_timed' => $this->faker->boolean,
            'duration' => $this->faker->randomNumber(0),
            'job_id' => $job->id,
        ];

        $response = $this->putJson(
            route('api.assesments.update', $assesment),
            $data
        );

        $data['id'] = $assesment->id;

        $this->assertDatabaseHas('assesments', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_assesment()
    {
        $assesment = Assesment::factory()->create();

        $response = $this->deleteJson(
            route('api.assesments.destroy', $assesment)
        );

        $this->assertModelMissing($assesment);

        $response->assertNoContent();
    }
}
