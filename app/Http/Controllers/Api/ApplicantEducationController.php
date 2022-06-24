<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ApplicantEducation;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApplicantEducationResource;
use App\Http\Resources\ApplicantEducationCollection;
use App\Http\Requests\ApplicantEducationStoreRequest;
use App\Http\Requests\ApplicantEducationUpdateRequest;

class ApplicantEducationController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', ApplicantEducation::class);

        $search = $request->get('search', '');

        $applicantEducations = ApplicantEducation::search($search)
            ->latest()
            ->paginate();

        return new ApplicantEducationCollection($applicantEducations);
    }

    /**
     * @param \App\Http\Requests\ApplicantEducationStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApplicantEducationStoreRequest $request)
    {
        $this->authorize('create', ApplicantEducation::class);

        $validated = $request->validated();

        $applicantEducation = ApplicantEducation::create($validated);

        return new ApplicantEducationResource($applicantEducation);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ApplicantEducation $applicantEducation
     * @return \Illuminate\Http\Response
     */
    public function show(
        Request $request,
        ApplicantEducation $applicantEducation
    ) {
        $this->authorize('view', $applicantEducation);

        return new ApplicantEducationResource($applicantEducation);
    }

    /**
     * @param \App\Http\Requests\ApplicantEducationUpdateRequest $request
     * @param \App\Models\ApplicantEducation $applicantEducation
     * @return \Illuminate\Http\Response
     */
    public function update(
        ApplicantEducationUpdateRequest $request,
        ApplicantEducation $applicantEducation
    ) {
        $this->authorize('update', $applicantEducation);

        $validated = $request->validated();

        $applicantEducation->update($validated);

        return new ApplicantEducationResource($applicantEducation);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ApplicantEducation $applicantEducation
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        ApplicantEducation $applicantEducation
    ) {
        $this->authorize('delete', $applicantEducation);

        $applicantEducation->delete();

        return response()->noContent();
    }
}
