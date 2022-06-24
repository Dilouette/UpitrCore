<?php

namespace App\Http\Controllers\Api;

use App\Models\JobApplicant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApplicantEducationResource;
use App\Http\Resources\ApplicantEducationCollection;

class JobApplicantApplicantEducationsController extends Controller
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

        $applicantEducations = $jobApplicant
            ->applicantEducations()
            ->search($search)
            ->latest()
            ->paginate();

        return new ApplicantEducationCollection($applicantEducations);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobApplicant $jobApplicant
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, JobApplicant $jobApplicant)
    {
        $this->authorize('create', ApplicantEducation::class);

        $validated = $request->validate([
            'institution' => ['required', 'max:255', 'string'],
            'field' => ['nullable', 'max:255', 'string'],
            'degree' => ['nullable', 'max:255', 'string'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date'],
        ]);

        $applicantEducation = $jobApplicant
            ->applicantEducations()
            ->create($validated);

        return new ApplicantEducationResource($applicantEducation);
    }
}
