<?php

namespace App\Http\Controllers\Api;

use App\Models\JobQuestion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApplicantResponseResource;
use App\Http\Resources\ApplicantResponseCollection;

class JobQuestionApplicantResponsesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobQuestion $jobQuestion
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, JobQuestion $jobQuestion)
    {
        $this->authorize('view', $jobQuestion);

        $search = $request->get('search', '');

        $applicantResponses = $jobQuestion
            ->applicantResponses()
            ->search($search)
            ->latest()
            ->paginate();

        return new ApplicantResponseCollection($applicantResponses);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobQuestion $jobQuestion
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, JobQuestion $jobQuestion)
    {
        $this->authorize('create', ApplicantResponse::class);

        $validated = $request->validate([
            'job_applicant_id' => ['required', 'exists:job_applicants,id'],
            'job_question_option_id' => [
                'nullable',
                'exists:job_question_options,id',
            ],
        ]);

        $applicantResponse = $jobQuestion
            ->applicantResponses()
            ->create($validated);

        return new ApplicantResponseResource($applicantResponse);
    }
}
