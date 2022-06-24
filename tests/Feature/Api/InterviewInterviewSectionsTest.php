<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Interview;
use App\Models\InterviewSection;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InterviewInterviewSectionsTest extends TestCase
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
    public function it_gets_interview_interview_sections()
    {
        $interview = Interview::factory()->create();
        $interviewSections = InterviewSection::factory()
            ->count(2)
            ->create([
                'interview_id' => $interview->id,
            ]);

        $response = $this->getJson(
            route('api.interviews.interview-sections.index', $interview)
        );

        $response->assertOk()->assertSee($interviewSections[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_interview_interview_sections()
    {
        $interview = Interview::factory()->create();
        $data = InterviewSection::factory()
            ->make([
                'interview_id' => $interview->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.interviews.interview-sections.store', $interview),
            $data
        );

        $this->assertDatabaseHas('interview_sections', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $interviewSection = InterviewSection::latest('id')->first();

        $this->assertEquals($interview->id, $interviewSection->interview_id);
    }
}
