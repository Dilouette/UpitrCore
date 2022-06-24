<?php

namespace App\Http\Controllers\Api;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Resources\NoteResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\NoteCollection;

class JobNotesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Job $job
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Job $job)
    {
        $this->authorize('view', $job);

        $search = $request->get('search', '');

        $notes = $job
            ->notes()
            ->search($search)
            ->latest()
            ->paginate();

        return new NoteCollection($notes);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Job $job
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Job $job)
    {
        $this->authorize('create', Note::class);

        $validated = $request->validate([
            'title' => ['required', 'max:255', 'string'],
            'content' => ['required', 'max:255', 'string'],
            'related_to_id' => ['required', 'max:255'],
            'created_by' => ['required', 'max:255'],
            'updated_by' => ['required', 'max:255'],
            'job_applicant_id' => ['required', 'exists:job_applicants,id'],
        ]);

        $note = $job->notes()->create($validated);

        return new NoteResource($note);
    }
}
