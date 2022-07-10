<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Note;

use App\Models\Job;
use App\Models\Applicant;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NoteTest extends TestCase
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
    public function it_gets_notes_list()
    {
        $notes = Note::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.notes.index'));

        $response->assertOk()->assertSee($notes[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_note()
    {
        $data = Note::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.notes.store'), $data);

        $this->assertDatabaseHas('notes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_note()
    {
        $note = Note::factory()->create();

        $job = Job::factory()->create();
        $applicant = Applicant::factory()->create();

        $data = [
            'title' => $this->faker->sentence(10),
            'content' => $this->faker->text,
            'related_to_id' => $this->faker->numberBetween(0, 127),
            'created_by' => $this->faker->randomNumber,
            'updated_by' => $this->faker->randomNumber,
            'job_id' => $job->id,
            'applicant_id' => $applicant->id,
        ];

        $response = $this->putJson(route('api.notes.update', $note), $data);

        $data['id'] = $note->id;

        $this->assertDatabaseHas('notes', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_note()
    {
        $note = Note::factory()->create();

        $response = $this->deleteJson(route('api.notes.destroy', $note));

        $this->assertModelMissing($note);

        $response->assertNoContent();
    }
}
