<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\EducationLevel;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EducationLevelTest extends TestCase
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
    public function it_gets_education_levels_list()
    {
        $educationLevels = EducationLevel::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.education-levels.index'));

        $response->assertOk()->assertSee($educationLevels[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_education_level()
    {
        $data = EducationLevel::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.education-levels.store'), $data);

        $this->assertDatabaseHas('education_levels', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_education_level()
    {
        $educationLevel = EducationLevel::factory()->create();

        $data = [
            'name' => $this->faker->name,
        ];

        $response = $this->putJson(
            route('api.education-levels.update', $educationLevel),
            $data
        );

        $data['id'] = $educationLevel->id;

        $this->assertDatabaseHas('education_levels', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_education_level()
    {
        $educationLevel = EducationLevel::factory()->create();

        $response = $this->deleteJson(
            route('api.education-levels.destroy', $educationLevel)
        );

        $this->assertModelMissing($educationLevel);

        $response->assertNoContent();
    }
}
