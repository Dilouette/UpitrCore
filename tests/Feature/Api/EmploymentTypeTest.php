<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\EmploymentType;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmploymentTypeTest extends TestCase
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
    public function it_gets_employment_types_list()
    {
        $employmentTypes = EmploymentType::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.employment-types.index'));

        $response->assertOk()->assertSee($employmentTypes[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_employment_type()
    {
        $data = EmploymentType::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.employment-types.store'), $data);

        $this->assertDatabaseHas('employment_types', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_employment_type()
    {
        $employmentType = EmploymentType::factory()->create();

        $data = [
            'name' => $this->faker->name,
        ];

        $response = $this->putJson(
            route('api.employment-types.update', $employmentType),
            $data
        );

        $data['id'] = $employmentType->id;

        $this->assertDatabaseHas('employment_types', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_employment_type()
    {
        $employmentType = EmploymentType::factory()->create();

        $response = $this->deleteJson(
            route('api.employment-types.destroy', $employmentType)
        );

        $this->assertModelMissing($employmentType);

        $response->assertNoContent();
    }
}
