<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Industry;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IndustryTest extends TestCase
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
    public function it_gets_industries_list()
    {
        $industries = Industry::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.industries.index'));

        $response->assertOk()->assertSee($industries[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_industry()
    {
        $data = Industry::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.industries.store'), $data);

        $this->assertDatabaseHas('industries', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_industry()
    {
        $industry = Industry::factory()->create();

        $data = [
            'name' => $this->faker->name,
        ];

        $response = $this->putJson(
            route('api.industries.update', $industry),
            $data
        );

        $data['id'] = $industry->id;

        $this->assertDatabaseHas('industries', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_industry()
    {
        $industry = Industry::factory()->create();

        $response = $this->deleteJson(
            route('api.industries.destroy', $industry)
        );

        $this->assertModelMissing($industry);

        $response->assertNoContent();
    }
}
