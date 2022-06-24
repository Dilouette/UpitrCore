<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\InteviewQuestion;

use App\Models\InterviewSection;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InteviewQuestionTest extends TestCase
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
    public function it_gets_inteview_questions_list()
    {
        $inteviewQuestions = InteviewQuestion::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.inteview-questions.index'));

        $response->assertOk()->assertSee($inteviewQuestions[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_inteview_question()
    {
        $data = InteviewQuestion::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.inteview-questions.store'),
            $data
        );

        $this->assertDatabaseHas('inteview_questions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_inteview_question()
    {
        $inteviewQuestion = InteviewQuestion::factory()->create();

        $interviewSection = InterviewSection::factory()->create();

        $data = [
            'question' => $this->faker->text,
            'title' => $this->faker->sentence(10),
            'interview_section_id' => $interviewSection->id,
        ];

        $response = $this->putJson(
            route('api.inteview-questions.update', $inteviewQuestion),
            $data
        );

        $data['id'] = $inteviewQuestion->id;

        $this->assertDatabaseHas('inteview_questions', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_inteview_question()
    {
        $inteviewQuestion = InteviewQuestion::factory()->create();

        $response = $this->deleteJson(
            route('api.inteview-questions.destroy', $inteviewQuestion)
        );

        $this->assertModelMissing($inteviewQuestion);

        $response->assertNoContent();
    }
}
