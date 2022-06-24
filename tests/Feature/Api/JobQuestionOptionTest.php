<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\JobQuestionOption;

use App\Models\JobQuestion;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobQuestionOptionTest extends TestCase
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
    public function it_gets_job_question_options_list()
    {
        $jobQuestionOptions = JobQuestionOption::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.job-question-options.index'));

        $response->assertOk()->assertSee($jobQuestionOptions[0]->option);
    }

    /**
     * @test
     */
    public function it_stores_the_job_question_option()
    {
        $data = JobQuestionOption::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.job-question-options.store'),
            $data
        );

        $this->assertDatabaseHas('job_question_options', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_job_question_option()
    {
        $jobQuestionOption = JobQuestionOption::factory()->create();

        $jobQuestion = JobQuestion::factory()->create();

        $data = [
            'option' => $this->faker->text(255),
            'job_question_id' => $jobQuestion->id,
        ];

        $response = $this->putJson(
            route('api.job-question-options.update', $jobQuestionOption),
            $data
        );

        $data['id'] = $jobQuestionOption->id;

        $this->assertDatabaseHas('job_question_options', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_job_question_option()
    {
        $jobQuestionOption = JobQuestionOption::factory()->create();

        $response = $this->deleteJson(
            route('api.job-question-options.destroy', $jobQuestionOption)
        );

        $this->assertModelMissing($jobQuestionOption);

        $response->assertNoContent();
    }
}
