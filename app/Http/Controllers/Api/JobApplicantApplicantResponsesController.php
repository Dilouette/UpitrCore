<?php

namespace App\Http\Controllers\Api;

use App\Models\JobApplicant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApplicantResponseResource;
use App\Http\Resources\ApplicantResponseCollection;

class JobApplicantApplicantResponsesController extends Controller
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

        $applicantResponses = $jobApplicant
            ->applicantResponses()
            ->search($search)
            ->latest()
            ->paginate();

        return new ApplicantResponseCollection($applicantResponses);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobApplicant $jobApplicant
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, JobApplicant $jobApplicant)
    {
        $this->authorize('create', ApplicantResponse::class);

        $validated = $request->validate([
            'job_question_id' => ['required', 'exists:job_questions,id'],
            'job_question_option_id' => [
                'nullable',
                'exists:job_question_options,id',
            ],
        ]);

        $applicantResponse = $jobApplicant
            ->applicantResponses()
            ->create($validated);

        return new ApplicantResponseResource($applicantResponse);
    }
}
