<?php

namespace App\Http\Controllers\Api;

use App\Models\Applicant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CandidateExperienceResource;
use App\Http\Resources\CandidateExperienceCollection;

class JobApplicantApplicantExperiencesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Applicant $applicant
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Applicant $applicant)
    {
        $this->authorize('view', $applicant);

        $search = $request->get('search', '');

        $applicantExperiences = $applicant
            ->applicantExperiences()
            ->search($search)
            ->latest()
            ->paginate();

        return new CandidateExperienceCollection($applicantExperiences);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Applicant $applicant
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Applicant $applicant)
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

        $applicantExperience = $applicant
            ->applicantExperiences()
            ->create($validated);

        return new CandidateExperienceResource($applicantExperience);
    }
}
