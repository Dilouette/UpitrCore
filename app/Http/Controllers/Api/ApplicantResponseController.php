<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ApplicantResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApplicantResponseResource;
use App\Http\Resources\ApplicantResponseCollection;
use App\Http\Requests\ApplicantResponseStoreRequest;
use App\Http\Requests\ApplicantResponseUpdateRequest;

class ApplicantResponseController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', ApplicantResponse::class);

        $search = $request->get('search', '');

        $applicantResponses = ApplicantResponse::search($search)
            ->latest()
            ->paginate();

        return new ApplicantResponseCollection($applicantResponses);
    }

    /**
     * @param \App\Http\Requests\ApplicantResponseStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApplicantResponseStoreRequest $request)
    {
        $this->authorize('create', ApplicantResponse::class);

        $validated = $request->validated();

        $applicantResponse = ApplicantResponse::create($validated);

        return new ApplicantResponseResource($applicantResponse);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ApplicantResponse $applicantResponse
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ApplicantResponse $applicantResponse)
    {
        $this->authorize('view', $applicantResponse);

        return new ApplicantResponseResource($applicantResponse);
    }

    /**
     * @param \App\Http\Requests\ApplicantResponseUpdateRequest $request
     * @param \App\Models\ApplicantResponse $applicantResponse
     * @return \Illuminate\Http\Response
     */
    public function update(
        ApplicantResponseUpdateRequest $request,
        ApplicantResponse $applicantResponse
    ) {
        $this->authorize('update', $applicantResponse);

        $validated = $request->validated();

        $applicantResponse->update($validated);

        return new ApplicantResponseResource($applicantResponse);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ApplicantResponse $applicantResponse
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        ApplicantResponse $applicantResponse
    ) {
        $this->authorize('delete', $applicantResponse);

        $applicantResponse->delete();

        return response()->noContent();
    }
}
