<?php

namespace Tests\Feature\Api;

use App\Models\Job;
use App\Models\User;
use App\Models\JobQuestion;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobJobQuestionsTest extends TestCase
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
    public function it_gets_job_job_questions()
    {
        $job = Job::factory()->create();
        $jobQuestions = JobQuestion::factory()
            ->count(2)
            ->create([
                'job_id' => $job->id,
            ]);

        $response = $this->getJson(route('api.jobs.job-questions.index', $job));

        $response->assertOk()->assertSee($jobQuestions[0]->question);
    }

    /**
     * @test
     */
    public function it_stores_the_job_job_questions()
    {
        $job = Job::factory()->create();
        $data = JobQuestion::factory()
            ->make([
                'job_id' => $job->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.jobs.job-questions.store', $job),
            $data
        );

        $this->assertDatabaseHas('job_questions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $jobQuestion = JobQuestion::latest('id')->first();

        $this->assertEquals($job->id, $jobQuestion->job_id);
    }
}
