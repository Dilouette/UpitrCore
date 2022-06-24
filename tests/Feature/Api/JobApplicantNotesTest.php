<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Note;
use App\Models\JobApplicant;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobApplicantNotesTest extends TestCase
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
    public function it_gets_job_applicant_notes()
    {
        $jobApplicant = JobApplicant::factory()->create();
        $notes = Note::factory()
            ->count(2)
            ->create([
                'job_applicant_id' => $jobApplicant->id,
            ]);

        $response = $this->getJson(
            route('api.job-applicants.notes.index', $jobApplicant)
        );

        $response->assertOk()->assertSee($notes[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_job_applicant_notes()
    {
        $jobApplicant = JobApplicant::factory()->create();
        $data = Note::factory()
            ->make([
                'job_applicant_id' => $jobApplicant->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.job-applicants.notes.store', $jobApplicant),
            $data
        );

        $this->assertDatabaseHas('notes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $note = Note::latest('id')->first();

        $this->assertEquals($jobApplicant->id, $note->job_applicant_id);
    }
}
