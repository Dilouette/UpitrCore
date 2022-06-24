<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Interview;

use App\Models\Job;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InterviewTest extends TestCase
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
    public function it_gets_interviews_list()
    {
        $interviews = Interview::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.interviews.index'));

        $response->assertOk()->assertSee($interviews[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_interview()
    {
        $data = Interview::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.interviews.store'), $data);

        $this->assertDatabaseHas('interviews', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_interview()
    {
        $interview = Interview::factory()->create();

        $job = Job::factory()->create();

        $data = [
            'type_id' => $this->faker->numberBetween(0, 127),
            'job_id' => $job->id,
        ];

        $response = $this->putJson(
            route('api.interviews.update', $interview),
            $data
        );

        $data['id'] = $interview->id;

        $this->assertDatabaseHas('interviews', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_interview()
    {
        $interview = Interview::factory()->create();

        $response = $this->deleteJson(
            route('api.interviews.destroy', $interview)
        );

        $this->assertModelMissing($interview);

        $response->assertNoContent();
    }
}
