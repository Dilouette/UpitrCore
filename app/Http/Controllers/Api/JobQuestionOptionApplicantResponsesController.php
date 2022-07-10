<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\JobQuestionOption;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApplicantResponseResource;
use App\Http\Resources\ApplicantResponseCollection;

class JobQuestionOptionApplicantResponsesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobQuestionOption $jobQuestionOption
     * @return \Illuminate\Http\Response
     */
    public function index(
        Request $request,
        JobQuestionOption $jobQuestionOption
    ) {
        $this->authorize('view', $jobQuestionOption);

        $search = $request->get('search', '');

        $applicantResponses = $jobQuestionOption
            ->applicantResponses()
            ->search($search)
            ->latest()
            ->paginate();

        return new ApplicantResponseCollection($applicantResponses);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobQuestionOption $jobQuestionOption
     * @return \Illuminate\Http\Response
     */
    public function store(
        Request $request,
        JobQuestionOption $jobQuestionOption
    ) {
        $this->authorize('create', ApplicantResponse::class);

        $validated = $request->validate([
            'applicant_id' => ['required', 'exists:applicants,id'],
            'job_question_id' => ['required', 'exists:job_questions,id'],
        ]);

        $applicantResponse = $jobQuestionOption
            ->applicantResponses()
            ->create($validated);

        return new ApplicantResponseResource($applicantResponse);
    }
}
