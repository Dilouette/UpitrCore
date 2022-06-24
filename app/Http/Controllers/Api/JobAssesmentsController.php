<?php

namespace App\Http\Controllers\Api;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AssesmentResource;
use App\Http\Resources\AssesmentCollection;

class JobAssesmentsController extends Controller
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

        $assesments = $job
            ->assesments()
            ->search($search)
            ->latest()
            ->paginate();

        return new AssesmentCollection($assesments);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Job $job
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Job $job)
    {
        $this->authorize('create', Assesment::class);

        $validated = $request->validate([
            'is_timed' => ['required', 'boolean'],
            'duration' => ['required', 'numeric'],
        ]);

        $assesment = $job->assesments()->create($validated);

        return new AssesmentResource($assesment);
    }
}
