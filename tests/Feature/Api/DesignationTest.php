<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Designation;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DesignationTest extends TestCase
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
    public function it_gets_designations_list()
    {
        $designations = Designation::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.designations.index'));

        $response->assertOk()->assertSee($designations[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_designation()
    {
        $data = Designation::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.designations.store'), $data);

        $this->assertDatabaseHas('designations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_designation()
    {
        $designation = Designation::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence(15),
            'created_by' => $this->faker->randomNumber(0),
        ];

        $response = $this->putJson(
            route('api.designations.update', $designation),
            $data
        );

        $data['id'] = $designation->id;

        $this->assertDatabaseHas('designations', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_designation()
    {
        $designation = Designation::factory()->create();

        $response = $this->deleteJson(
            route('api.designations.destroy', $designation)
        );

        $this->assertModelMissing($designation);

        $response->assertNoContent();
    }
}
