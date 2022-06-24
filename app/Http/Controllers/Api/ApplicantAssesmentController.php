<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ApplicantAssesment;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApplicantAssesmentResource;
use App\Http\Resources\ApplicantAssesmentCollection;
use App\Http\Requests\ApplicantAssesmentStoreRequest;
use App\Http\Requests\ApplicantAssesmentUpdateRequest;

class ApplicantAssesmentController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', ApplicantAssesment::class);

        $search = $request->get('search', '');

        $applicantAssesments = ApplicantAssesment::search($search)
            ->latest()
            ->paginate();

        return new ApplicantAssesmentCollection($applicantAssesments);
    }

    /**
     * @param \App\Http\Requests\ApplicantAssesmentStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApplicantAssesmentStoreRequest $request)
    {
        $this->authorize('create', ApplicantAssesment::class);

        $validated = $request->validated();

        $applicantAssesment = ApplicantAssesment::create($validated);

        return new ApplicantAssesmentResource($applicantAssesment);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ApplicantAssesment $applicantAssesment
     * @return \Illuminate\Http\Response
     */
    public function show(
        Request $request,
        ApplicantAssesment $applicantAssesment
    ) {
        $this->authorize('view', $applicantAssesment);

        return new ApplicantAssesmentResource($applicantAssesment);
    }

    /**
     * @param \App\Http\Requests\ApplicantAssesmentUpdateRequest $request
     * @param \App\Models\ApplicantAssesment $applicantAssesment
     * @return \Illuminate\Http\Response
     */
    public function update(
        ApplicantAssesmentUpdateRequest $request,
        ApplicantAssesment $applicantAssesment
    ) {
        $this->authorize('update', $applicantAssesment);

        $validated = $request->validated();

        $applicantAssesment->update($validated);

        return new ApplicantAssesmentResource($applicantAssesment);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ApplicantAssesment $applicantAssesment
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        ApplicantAssesment $applicantAssesment
    ) {
        $this->authorize('delete', $applicantAssesment);

        $applicantAssesment->delete();

        return response()->noContent();
    }
}
