<?php

namespace App\Http\Controllers\Api;

use App\Models\JobApplicant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApplicantAssesmentResource;
use App\Http\Resources\ApplicantAssesmentCollection;

class JobApplicantApplicantAssesmentsController extends Controller
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

        $applicantAssesments = $jobApplicant
            ->applicantAssesments()
            ->search($search)
            ->latest()
            ->paginate();

        return new ApplicantAssesmentCollection($applicantAssesments);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobApplicant $jobApplicant
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, JobApplicant $jobApplicant)
    {
        $this->authorize('create', ApplicantAssesment::class);

        $validated = $request->validate([
            'status_id' => ['nullable', 'max:255'],
            'score' => ['nullable', 'numeric'],
            'start_time' => ['required', 'date'],
            'end_time' => ['required', 'date'],
            'ip' => ['required', 'max:255'],
            'user_agent' => ['required', 'max:255', 'string'],
        ]);

        $applicantAssesment = $jobApplicant
            ->applicantAssesments()
            ->create($validated);

        return new ApplicantAssesmentResource($applicantAssesment);
    }
}
