<?php

namespace App\Http\Controllers\Api;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\InterviewResource;
use App\Http\Resources\InterviewCollection;

class JobInterviewsController extends Controller
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

        $interviews = $job
            ->interviews()
            ->search($search)
            ->latest()
            ->paginate();

        return new InterviewCollection($interviews);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Job $job
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Job $job)
    {
        $this->authorize('create', Interview::class);

        $validated = $request->validate([
            'type_id' => ['required', 'max:255'],
        ]);

        $interview = $job->interviews()->create($validated);

        return new InterviewResource($interview);
    }
}
