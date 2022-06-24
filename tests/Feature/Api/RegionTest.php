<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Region;

use App\Models\Country;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegionTest extends TestCase
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
    public function it_gets_regions_list()
    {
        $regions = Region::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.regions.index'));

        $response->assertOk()->assertSee($regions[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_region()
    {
        $data = Region::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.regions.store'), $data);

        $this->assertDatabaseHas('regions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_region()
    {
        $region = Region::factory()->create();

        $country = Country::factory()->create();

        $data = [
            'country_id' => $this->faker->randomNumber(0),
            'name' => $this->faker->name,
            'country_id' => $country->id,
        ];

        $response = $this->putJson(route('api.regions.update', $region), $data);

        $data['id'] = $region->id;

        $this->assertDatabaseHas('regions', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_region()
    {
        $region = Region::factory()->create();

        $response = $this->deleteJson(route('api.regions.destroy', $region));

        $this->assertModelMissing($region);

        $response->assertNoContent();
    }
}
