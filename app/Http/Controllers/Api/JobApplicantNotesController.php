<?php

namespace App\Http\Controllers\Api;

use App\Models\Applicant;
use Illuminate\Http\Request;
use App\Http\Resources\NoteResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\NoteCollection;

class JobApplicantNotesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Applicant $applicant
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Applicant $applicant)
    {
        $this->authorize('view', $applicant);

        $search = $request->get('search', '');

        $notes = $applicant
            ->notes()
            ->search($search)
            ->latest()
            ->paginate();

        return new NoteCollection($notes);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Applicant $applicant
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Applicant $applicant)
    {
        $this->authorize('create', Note::class);

        $validated = $request->validate([
            'title' => ['required', 'max:255', 'string'],
            'content' => ['required', 'max:255', 'string'],
            'related_to_id' => ['required', 'max:255'],
            'created_by' => ['required', 'max:255'],
            'job_id' => ['required', 'exists:jobs,id'],
            'updated_by' => ['required', 'max:255'],
        ]);

        $note = $applicant->notes()->create($validated);

        return new NoteResource($note);
    }
}
