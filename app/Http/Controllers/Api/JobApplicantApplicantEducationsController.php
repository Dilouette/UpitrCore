<?php

namespace App\Http\Controllers\Api;

use App\Models\Applicant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CandidateEducationResource;
use App\Http\Resources\CandidateEducationCollection;

class JobApplicantApplicantEducationsController extends Controller
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

        $applicantEducations = $applicant
            ->applicantEducations()
            ->search($search)
            ->latest()
            ->paginate();

        return new CandidateEducationCollection($applicantEducations);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Applicant $applicant
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Applicant $applicant)
    {
        $this->authorize('create', ApplicantEducation::class);

        $validated = $request->validate([
            'institution' => ['required', 'max:255', 'string'],
            'field' => ['nullable', 'max:255', 'string'],
            'degree' => ['nullable', 'max:255', 'string'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date'],
        ]);

        $applicantEducation = $applicant
            ->applicantEducations()
            ->create($validated);

        return new CandidateEducationResource($applicantEducation);
    }
}
