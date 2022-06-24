<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\City;

use App\Models\Region;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CityTest extends TestCase
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
    public function it_gets_cities_list()
    {
        $cities = City::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.cities.index'));

        $response->assertOk()->assertSee($cities[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_city()
    {
        $data = City::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.cities.store'), $data);

        $this->assertDatabaseHas('cities', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_city()
    {
        $city = City::factory()->create();

        $region = Region::factory()->create();

        $data = [
            'region_id' => $this->faker->randomNumber(0),
            'name' => $this->faker->name,
            'region_id' => $region->id,
        ];

        $response = $this->putJson(route('api.cities.update', $city), $data);

        $data['id'] = $city->id;

        $this->assertDatabaseHas('cities', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_city()
    {
        $city = City::factory()->create();

        $response = $this->deleteJson(route('api.cities.destroy', $city));

        $this->assertModelMissing($city);

        $response->assertNoContent();
    }
}
