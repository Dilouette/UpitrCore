<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ApplicantInterview;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApplicantInterviewFeedbackResource;
use App\Http\Resources\ApplicantInterviewFeedbackCollection;

class ApplicantInterviewApplicantInterviewFeedbacksController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ApplicantInterview $applicantInterview
     * @return \Illuminate\Http\Response
     */
    public function index(
        Request $request,
        ApplicantInterview $applicantInterview
    ) {
        $this->authorize('view', $applicantInterview);

        $search = $request->get('search', '');

        $applicantInterviewFeedbacks = $applicantInterview
            ->applicantInterviewFeedbacks()
            ->search($search)
            ->latest()
            ->paginate();

        return new ApplicantInterviewFeedbackCollection(
            $applicantInterviewFeedbacks
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ApplicantInterview $applicantInterview
     * @return \Illuminate\Http\Response
     */
    public function store(
        Request $request,
        ApplicantInterview $applicantInterview
    ) {
        $this->authorize('create', ApplicantInterviewFeedback::class);

        $validated = $request->validate([
            'inteview_question_id' => [
                'required',
                'exists:inteview_questions,id',
            ],
            'rating' => ['required', 'max:255'],
        ]);

        $applicantInterviewFeedback = $applicantInterview
            ->applicantInterviewFeedbacks()
            ->create($validated);

        return new ApplicantInterviewFeedbackResource(
            $applicantInterviewFeedback
        );
    }
}
