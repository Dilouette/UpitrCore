<?php

namespace App\Http\Controllers\Api;

use App\Models\Applicant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApplicantInterviewResource;
use App\Http\Resources\ApplicantInterviewCollection;

class JobApplicantApplicantInterviewsController extends Controller
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

        $applicantInterviews = $applicant
            ->applicantInterviews()
            ->search($search)
            ->latest()
            ->paginate();

        return new ApplicantInterviewCollection($applicantInterviews);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Applicant $applicant
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Applicant $applicant)
    {
        $this->authorize('create', ApplicantInterview::class);

        $validated = $request->validate([
            'score' => ['required', 'max:255'],
            'feedback' => ['required', 'max:255', 'string'],
            'start_time' => ['required', 'date'],
            'end_time' => ['required', 'date'],
        ]);

        $applicantInterview = $applicant
            ->applicantInterviews()
            ->create($validated);

        return new ApplicantInterviewResource($applicantInterview);
    }
}
