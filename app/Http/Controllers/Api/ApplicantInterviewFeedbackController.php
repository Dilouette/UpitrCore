<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ApplicantInterviewFeedback;
use App\Http\Resources\ApplicantInterviewFeedbackResource;
use App\Http\Resources\ApplicantInterviewFeedbackCollection;
use App\Http\Requests\ApplicantInterviewFeedbackStoreRequest;
use App\Http\Requests\ApplicantInterviewFeedbackUpdateRequest;

class ApplicantInterviewFeedbackController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', ApplicantInterviewFeedback::class);

        $search = $request->get('search', '');

        $applicantInterviewFeedbacks = ApplicantInterviewFeedback::search(
            $search
        )
            ->latest()
            ->paginate();

        return new ApplicantInterviewFeedbackCollection(
            $applicantInterviewFeedbacks
        );
    }

    /**
     * @param \App\Http\Requests\ApplicantInterviewFeedbackStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApplicantInterviewFeedbackStoreRequest $request)
    {
        $this->authorize('create', ApplicantInterviewFeedback::class);

        $validated = $request->validated();

        $applicantInterviewFeedback = ApplicantInterviewFeedback::create(
            $validated
        );

        return new ApplicantInterviewFeedbackResource(
            $applicantInterviewFeedback
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ApplicantInterviewFeedback $applicantInterviewFeedback
     * @return \Illuminate\Http\Response
     */
    public function show(
        Request $request,
        ApplicantInterviewFeedback $applicantInterviewFeedback
    ) {
        $this->authorize('view', $applicantInterviewFeedback);

        return new ApplicantInterviewFeedbackResource(
            $applicantInterviewFeedback
        );
    }

    /**
     * @param \App\Http\Requests\ApplicantInterviewFeedbackUpdateRequest $request
     * @param \App\Models\ApplicantInterviewFeedback $applicantInterviewFeedback
     * @return \Illuminate\Http\Response
     */
    public function update(
        ApplicantInterviewFeedbackUpdateRequest $request,
        ApplicantInterviewFeedback $applicantInterviewFeedback
    ) {
        $this->authorize('update', $applicantInterviewFeedback);

        $validated = $request->validated();

        $applicantInterviewFeedback->update($validated);

        return new ApplicantInterviewFeedbackResource(
            $applicantInterviewFeedback
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ApplicantInterviewFeedback $applicantInterviewFeedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        ApplicantInterviewFeedback $applicantInterviewFeedback
    ) {
        $this->authorize('delete', $applicantInterviewFeedback);

        $applicantInterviewFeedback->delete();

        return response()->noContent();
    }
}
