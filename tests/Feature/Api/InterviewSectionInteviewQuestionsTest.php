<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\InterviewSection;
use App\Models\InteviewQuestion;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InterviewSectionInteviewQuestionsTest extends TestCase
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
    public function it_gets_interview_section_inteview_questions()
    {
        $interviewSection = InterviewSection::factory()->create();
        $inteviewQuestions = InteviewQuestion::factory()
            ->count(2)
            ->create([
                'interview_section_id' => $interviewSection->id,
            ]);

        $response = $this->getJson(
            route(
                'api.interview-sections.inteview-questions.index',
                $interviewSection
            )
        );

        $response->assertOk()->assertSee($inteviewQuestions[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_interview_section_inteview_questions()
    {
        $interviewSection = InterviewSection::factory()->create();
        $data = InteviewQuestion::factory()
            ->make([
                'interview_section_id' => $interviewSection->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.interview-sections.inteview-questions.store',
                $interviewSection
            ),
            $data
        );

        $this->assertDatabaseHas('inteview_questions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $inteviewQuestion = InteviewQuestion::latest('id')->first();

        $this->assertEquals(
            $interviewSection->id,
            $inteviewQuestion->interview_section_id
        );
    }
}
