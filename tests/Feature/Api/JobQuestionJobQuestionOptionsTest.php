<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\JobQuestion;
use App\Models\JobQuestionOption;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobQuestionJobQuestionOptionsTest extends TestCase
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
    public function it_gets_job_question_job_question_options()
    {
        $jobQuestion = JobQuestion::factory()->create();
        $jobQuestionOptions = JobQuestionOption::factory()
            ->count(2)
            ->create([
                'job_question_id' => $jobQuestion->id,
            ]);

        $response = $this->getJson(
            route('api.job-questions.job-question-options.index', $jobQuestion)
        );

        $response->assertOk()->assertSee($jobQuestionOptions[0]->option);
    }

    /**
     * @test
     */
    public function it_stores_the_job_question_job_question_options()
    {
        $jobQuestion = JobQuestion::factory()->create();
        $data = JobQuestionOption::factory()
            ->make([
                'job_question_id' => $jobQuestion->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.job-questions.job-question-options.store', $jobQuestion),
            $data
        );

        $this->assertDatabaseHas('job_question_options', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $jobQuestionOption = JobQuestionOption::latest('id')->first();

        $this->assertEquals(
            $jobQuestion->id,
            $jobQuestionOption->job_question_id
        );
    }
}
