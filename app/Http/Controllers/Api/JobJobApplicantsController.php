<?php

namespace App\Http\Controllers\Api;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\JobApplicantResource;
use App\Http\Resources\JobApplicantCollection;

class JobJobApplicantsController extends Controller
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

        $jobApplicants = $job
            ->applications()
            ->search($search)
            ->latest()
            ->paginate();

        return new JobApplicantCollection($jobApplicants);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Job $job
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Job $job)
    {
        $this->authorize('create', JobApplicant::class);

        $validated = $request->validate([
            'firstname' => ['required', 'max:255', 'string'],
            'lastname' => ['required', 'max:255', 'string'],
            'email' => ['required', 'email'],
            'phone' => ['nullable', 'max:255', 'string'],
            'headline' => ['nullable', 'max:255', 'string'],
            'address' => ['nullable', 'max:255', 'string'],
            'photo' => ['nullable', 'file'],
            'summary' => ['nullable', 'max:255', 'string'],
            'resume' => ['nullable', 'max:255', 'string'],
            'cover_letter' => ['nullable', 'max:255', 'string'],
            'cv' => ['nullable', 'max:255', 'string'],
            'job_workflow_stage_id' => [
                'required',
                'exists:job_workflow_stages,id',
            ],
            'consideration_id' => ['required', 'max:255'],
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('public');
        }

        $jobApplicant = $job->applications()->create($validated);

        return new JobApplicantResource($jobApplicant);
    }
}
