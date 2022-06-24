<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ApplicantInterview;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApplicantInterviewResource;
use App\Http\Resources\ApplicantInterviewCollection;
use App\Http\Requests\ApplicantInterviewStoreRequest;
use App\Http\Requests\ApplicantInterviewUpdateRequest;

class ApplicantInterviewController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', ApplicantInterview::class);

        $search = $request->get('search', '');

        $applicantInterviews = ApplicantInterview::search($search)
            ->latest()
            ->paginate();

        return new ApplicantInterviewCollection($applicantInterviews);
    }

    /**
     * @param \App\Http\Requests\ApplicantInterviewStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApplicantInterviewStoreRequest $request)
    {
        $this->authorize('create', ApplicantInterview::class);

        $validated = $request->validated();

        $applicantInterview = ApplicantInterview::create($validated);

        return new ApplicantInterviewResource($applicantInterview);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ApplicantInterview $applicantInterview
     * @return \Illuminate\Http\Response
     */
    public function show(
        Request $request,
        ApplicantInterview $applicantInterview
    ) {
        $this->authorize('view', $applicantInterview);

        return new ApplicantInterviewResource($applicantInterview);
    }

    /**
     * @param \App\Http\Requests\ApplicantInterviewUpdateRequest $request
     * @param \App\Models\ApplicantInterview $applicantInterview
     * @return \Illuminate\Http\Response
     */
    public function update(
        ApplicantInterviewUpdateRequest $request,
        ApplicantInterview $applicantInterview
    ) {
        $this->authorize('update', $applicantInterview);

        $validated = $request->validated();

        $applicantInterview->update($validated);

        return new ApplicantInterviewResource($applicantInterview);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ApplicantInterview $applicantInterview
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        ApplicantInterview $applicantInterview
    ) {
        $this->authorize('delete', $applicantInterview);

        $applicantInterview->delete();

        return response()->noContent();
    }
}
