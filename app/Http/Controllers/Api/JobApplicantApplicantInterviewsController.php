<?php

namespace App\Http\Controllers\Api;

use App\Models\JobApplicant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApplicantInterviewResource;
use App\Http\Resources\ApplicantInterviewCollection;

class JobApplicantApplicantInterviewsController extends Controller
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

        $applicantInterviews = $jobApplicant
            ->applicantInterviews()
            ->search($search)
            ->latest()
            ->paginate();

        return new ApplicantInterviewCollection($applicantInterviews);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobApplicant $jobApplicant
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, JobApplicant $jobApplicant)
    {
        $this->authorize('create', ApplicantInterview::class);

        $validated = $request->validate([
            'score' => ['required', 'max:255'],
            'feedback' => ['required', 'max:255', 'string'],
            'start_time' => ['required', 'date'],
            'end_time' => ['required', 'date'],
        ]);

        $applicantInterview = $jobApplicant
            ->applicantInterviews()
            ->create($validated);

        return new ApplicantInterviewResource($applicantInterview);
    }
}
