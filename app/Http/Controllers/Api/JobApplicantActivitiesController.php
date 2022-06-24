<?php

namespace App\Http\Controllers\Api;

use App\Models\JobApplicant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\ActivityCollection;

class JobApplicantActivitiesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobApplicant $jobApplicant
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, JobApplicant $jobApplicant)
    {
        $this->authorize('view', $jobApplicant);

        $search = $request->get('search', '');

        $activities = $jobApplicant
            ->activities()
            ->search($search)
            ->latest()
            ->paginate();

        return new ActivityCollection($activities);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobApplicant $jobApplicant
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, JobApplicant $jobApplicant)
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
            'job_id' => ['nullable', 'exists:jobs,id'],
        ]);

        $activity = $jobApplicant->activities()->create($validated);

        return new ActivityResource($activity);
    }
}
