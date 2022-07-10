<?php

namespace App\Http\Controllers\Api;

use App\Models\Applicant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApplicantResponseResource;
use App\Http\Resources\ApplicantResponseCollection;

class JobApplicantApplicantResponsesController extends Controller
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

        $applicantResponses = $applicant
            ->applicantResponses()
            ->search($search)
            ->latest()
            ->paginate();

        return new ApplicantResponseCollection($applicantResponses);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Applicant $applicant
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Applicant $applicant)
    {
        $this->authorize('create', ApplicantResponse::class);

        $validated = $request->validate([
            'job_question_id' => ['required', 'exists:job_questions,id'],
            'job_question_option_id' => [
                'nullable',
                'exists:job_question_options,id',
            ],
        ]);

        $applicantResponse = $applicant
            ->applicantResponses()
            ->create($validated);

        return new ApplicantResponseResource($applicantResponse);
    }
}
