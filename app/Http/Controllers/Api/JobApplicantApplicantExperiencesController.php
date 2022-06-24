<?php

namespace App\Http\Controllers\Api;

use App\Models\JobApplicant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApplicantExperienceResource;
use App\Http\Resources\ApplicantExperienceCollection;

class JobApplicantApplicantExperiencesController extends Controller
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

        $applicantExperiences = $jobApplicant
            ->applicantExperiences()
            ->search($search)
            ->latest()
            ->paginate();

        return new ApplicantExperienceCollection($applicantExperiences);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobApplicant $jobApplicant
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, JobApplicant $jobApplicant)
    {
        $this->authorize('create', ApplicantExperience::class);

        $validated = $request->validate([
            'title' => ['required', 'max:255', 'string'],
            'company' => ['nullable', 'max:255', 'string'],
            'industry_id' => ['nullable', 'numeric'],
            'summary' => ['nullable', 'max:255', 'string'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date'],
        ]);

        $applicantExperience = $jobApplicant
            ->applicantExperiences()
            ->create($validated);

        return new ApplicantExperienceResource($applicantExperience);
    }
}
