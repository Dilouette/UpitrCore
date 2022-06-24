<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Region;
use App\Models\Country;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CountryRegionsTest extends TestCase
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
    public function it_gets_country_regions()
    {
        $country = Country::factory()->create();
        $regions = Region::factory()
            ->count(2)
            ->create([
                'country_id' => $country->id,
            ]);

        $response = $this->getJson(
            route('api.countries.regions.index', $country)
        );

        $response->assertOk()->assertSee($regions[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_country_regions()
    {
        $country = Country::factory()->create();
        $data = Region::factory()
            ->make([
                'country_id' => $country->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.countries.regions.store', $country),
            $data
        );

        $this->assertDatabaseHas('regions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $region = Region::latest('id')->first();

        $this->assertEquals($country->id, $region->country_id);
    }
}
