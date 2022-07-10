<?php

namespace App\Http\Controllers\Api;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\ActivityCollection;

class JobActivitiesController extends Controller
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

        $activities = $job
            ->activities()
            ->search($search)
            ->latest()
            ->paginate();

        return new ActivityCollection($activities);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Job $job
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Job $job)
    {
        $this->authorize('create', Activity::class);

        $validated = $request->validate([
            'activity_type_id' => ['required', 'max:255'],
            'title' => ['required', 'max:255', 'string'],
            'start' => ['required', 'date'],
            'end' => ['required', 'date'],
            'location' => ['required', 'max:255', 'string'],
            'meeting_url' => ['required', 'max:255', 'string'],
            'related_to_id' => ['required', 'max:255'],
            'importance_id' => ['required', 'max:255'],
            'description' => ['required', 'max:255', 'string'],
            'created_by' => ['required', 'max:255'],
            'updated_by' => ['required', 'max:255'],
            'applicant_id' => ['nullable', 'exists:applicants,id'],
        ]);

        $activity = $job->activities()->create($validated);

        return new ActivityResource($activity);
    }
}
