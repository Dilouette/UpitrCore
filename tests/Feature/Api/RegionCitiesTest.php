<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\City;
use App\Models\Region;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegionCitiesTest extends TestCase
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
    public function it_gets_region_cities()
    {
        $region = Region::factory()->create();
        $cities = City::factory()
            ->count(2)
            ->create([
                'region_id' => $region->id,
            ]);

        $response = $this->getJson(route('api.regions.cities.index', $region));

        $response->assertOk()->assertSee($cities[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_region_cities()
    {
        $region = Region::factory()->create();
        $data = City::factory()
            ->make([
                'region_id' => $region->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.regions.cities.store', $region),
            $data
        );

        $this->assertDatabaseHas('cities', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $city = City::latest('id')->first();

        $this->assertEquals($region->id, $city->region_id);
    }
}
