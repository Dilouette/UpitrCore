<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\JobQuestion;

use App\Models\Job;
use App\Models\QuestionType;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobQuestionTest extends TestCase
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
    public function it_gets_job_questions_list()
    {
        $jobQuestions = JobQuestion::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.job-questions.index'));

        $response->assertOk()->assertSee($jobQuestions[0]->question);
    }

    /**
     * @test
     */
    public function it_stores_the_job_question()
    {
        $data = JobQuestion::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.job-questions.store'), $data);

        $this->assertDatabaseHas('job_questions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_job_question()
    {
        $jobQuestion = JobQuestion::factory()->create();

        $job = Job::factory()->create();
        $questionType = QuestionType::factory()->create();

        $data = [
            'question' => $this->faker->text,
            'job_id' => $job->id,
            'job_question_type_id' => $questionType->id,
        ];

        $response = $this->putJson(
            route('api.job-questions.update', $jobQuestion),
            $data
        );

        $data['id'] = $jobQuestion->id;

        $this->assertDatabaseHas('job_questions', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_job_question()
    {
        $jobQuestion = JobQuestion::factory()->create();

        $response = $this->deleteJson(
            route('api.job-questions.destroy', $jobQuestion)
        );

        $this->assertModelMissing($jobQuestion);

        $response->assertNoContent();
    }
}
