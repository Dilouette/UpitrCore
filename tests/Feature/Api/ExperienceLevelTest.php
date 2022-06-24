<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ExperienceLevel;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExperienceLevelTest extends TestCase
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
    public function it_gets_experience_levels_list()
    {
        $experienceLevels = ExperienceLevel::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.experience-levels.index'));

        $response->assertOk()->assertSee($experienceLevels[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_experience_level()
    {
        $data = ExperienceLevel::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.experience-levels.store'),
            $data
        );

        $this->assertDatabaseHas('experience_levels', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_experience_level()
    {
        $experienceLevel = ExperienceLevel::factory()->create();

        $data = [
            'name' => $this->faker->text(255),
        ];

        $response = $this->putJson(
            route('api.experience-levels.update', $experienceLevel),
            $data
        );

        $data['id'] = $experienceLevel->id;

        $this->assertDatabaseHas('experience_levels', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_experience_level()
    {
        $experienceLevel = ExperienceLevel::factory()->create();

        $response = $this->deleteJson(
            route('api.experience-levels.destroy', $experienceLevel)
        );

        $this->assertModelMissing($experienceLevel);

        $response->assertNoContent();
    }
}
