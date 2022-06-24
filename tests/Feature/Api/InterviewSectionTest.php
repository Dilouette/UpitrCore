<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\InterviewSection;

use App\Models\Interview;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InterviewSectionTest extends TestCase
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
    public function it_gets_interview_sections_list()
    {
        $interviewSections = InterviewSection::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.interview-sections.index'));

        $response->assertOk()->assertSee($interviewSections[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_interview_section()
    {
        $data = InterviewSection::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.interview-sections.store'),
            $data
        );

        $this->assertDatabaseHas('interview_sections', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_interview_section()
    {
        $interviewSection = InterviewSection::factory()->create();

        $interview = Interview::factory()->create();

        $data = [
            'title' => $this->faker->sentence(10),
            'description' => $this->faker->sentence(15),
            'interview_id' => $interview->id,
        ];

        $response = $this->putJson(
            route('api.interview-sections.update', $interviewSection),
            $data
        );

        $data['id'] = $interviewSection->id;

        $this->assertDatabaseHas('interview_sections', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_interview_section()
    {
        $interviewSection = InterviewSection::factory()->create();

        $response = $this->deleteJson(
            route('api.interview-sections.destroy', $interviewSection)
        );

        $this->assertModelMissing($interviewSection);

        $response->assertNoContent();
    }
}
