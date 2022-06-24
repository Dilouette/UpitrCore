<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\JobWorkflowStage;
use App\Http\Controllers\Controller;
use App\Http\Resources\JobApplicantResource;
use App\Http\Resources\JobApplicantCollection;

class JobWorkflowStageJobApplicantsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobWorkflowStage $jobWorkflowStage
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, JobWorkflowStage $jobWorkflowStage)
    {
        $this->authorize('view', $jobWorkflowStage);

        $search = $request->get('search', '');

        $jobApplicants = $jobWorkflowStage
            ->jobApplicants()
            ->search($search)
            ->latest()
            ->paginate();

        return new JobApplicantCollection($jobApplicants);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobWorkflowStage $jobWorkflowStage
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, JobWorkflowStage $jobWorkflowStage)
    {
        $this->authorize('create', JobApplicant::class);

        $validated = $request->validate([
            'job_id' => ['required', 'numeric', 'exists:jobs,id'],
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
            'consideration_id' => ['required', 'max:255'],
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('public');
        }

        $jobApplicant = $jobWorkflowStage->jobApplicants()->create($validated);

        return new JobApplicantResource($jobApplicant);
    }
}
