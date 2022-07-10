<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Note;
use App\Models\Applicant;

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
        $applicant = Applicant::factory()->create();
        $notes = Note::factory()
            ->count(2)
            ->create([
                'applicant_id' => $applicant->id,
            ]);

        $response = $this->getJson(
            route('api.job-applicants.notes.index', $applicant)
        );

        $response->assertOk()->assertSee($notes[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_job_applicant_notes()
    {
        $applicant = Applicant::factory()->create();
        $data = Note::factory()
            ->make([
                'applicant_id' => $applicant->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.job-applicants.notes.store', $applicant),
            $data
        );

        $this->assertDatabaseHas('notes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $note = Note::latest('id')->first();

        $this->assertEquals($applicant->id, $note->applicant_id);
    }
}
