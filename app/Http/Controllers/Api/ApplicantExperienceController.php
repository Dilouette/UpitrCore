<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ApplicantExperience;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApplicantExperienceResource;
use App\Http\Resources\ApplicantExperienceCollection;
use App\Http\Requests\ApplicantExperienceStoreRequest;
use App\Http\Requests\ApplicantExperienceUpdateRequest;

class ApplicantExperienceController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', ApplicantExperience::class);

        $search = $request->get('search', '');

        $applicantExperiences = ApplicantExperience::search($search)
            ->latest()
            ->paginate();

        return new ApplicantExperienceCollection($applicantExperiences);
    }

    /**
     * @param \App\Http\Requests\ApplicantExperienceStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApplicantExperienceStoreRequest $request)
    {
        $this->authorize('create', ApplicantExperience::class);

        $validated = $request->validated();

        $applicantExperience = ApplicantExperience::create($validated);

        return new ApplicantExperienceResource($applicantExperience);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ApplicantExperience $applicantExperience
     * @return \Illuminate\Http\Response
     */
    public function show(
        Request $request,
        ApplicantExperience $applicantExperience
    ) {
        $this->authorize('view', $applicantExperience);

        return new ApplicantExperienceResource($applicantExperience);
    }

    /**
     * @param \App\Http\Requests\ApplicantExperienceUpdateRequest $request
     * @param \App\Models\ApplicantExperience $applicantExperience
     * @return \Illuminate\Http\Response
     */
    public function update(
        ApplicantExperienceUpdateRequest $request,
        ApplicantExperience $applicantExperience
    ) {
        $this->authorize('update', $applicantExperience);

        $validated = $request->validated();

        $applicantExperience->update($validated);

        return new ApplicantExperienceResource($applicantExperience);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ApplicantExperience $applicantExperience
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        ApplicantExperience $applicantExperience
    ) {
        $this->authorize('delete', $applicantExperience);

        $applicantExperience->delete();

        return response()->noContent();
    }
}
