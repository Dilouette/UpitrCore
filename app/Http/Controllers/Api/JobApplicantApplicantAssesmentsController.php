<?php

namespace App\Http\Controllers\Api;

use App\Models\Applicant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApplicantAssesmentResource;
use App\Http\Resources\ApplicantAssesmentCollection;

class JobApplicantApplicantAssesmentsController extends Controller
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

        $applicantAssesments = $applicant
            ->applicantAssesments()
            ->search($search)
            ->latest()
            ->paginate();

        return new ApplicantAssesmentCollection($applicantAssesments);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Applicant $applicant
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Applicant $applicant)
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

        $applicantAssesment = $applicant
            ->applicantAssesments()
            ->create($validated);

        return new ApplicantAssesmentResource($applicantAssesment);
    }
}
