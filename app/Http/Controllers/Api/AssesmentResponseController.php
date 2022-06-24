<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AssesmentResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\AssesmentResponseResource;
use App\Http\Resources\AssesmentResponseCollection;
use App\Http\Requests\AssesmentResponseStoreRequest;
use App\Http\Requests\AssesmentResponseUpdateRequest;

class AssesmentResponseController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', AssesmentResponse::class);

        $search = $request->get('search', '');

        $assesmentResponses = AssesmentResponse::search($search)
            ->latest()
            ->paginate();

        return new AssesmentResponseCollection($assesmentResponses);
    }

    /**
     * @param \App\Http\Requests\AssesmentResponseStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssesmentResponseStoreRequest $request)
    {
        $this->authorize('create', AssesmentResponse::class);

        $validated = $request->validated();

        $assesmentResponse = AssesmentResponse::create($validated);

        return new AssesmentResponseResource($assesmentResponse);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AssesmentResponse $assesmentResponse
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, AssesmentResponse $assesmentResponse)
    {
        $this->authorize('view', $assesmentResponse);

        return new AssesmentResponseResource($assesmentResponse);
    }

    /**
     * @param \App\Http\Requests\AssesmentResponseUpdateRequest $request
     * @param \App\Models\AssesmentResponse $assesmentResponse
     * @return \Illuminate\Http\Response
     */
    public function update(
        AssesmentResponseUpdateRequest $request,
        AssesmentResponse $assesmentResponse
    ) {
        $this->authorize('update', $assesmentResponse);

        $validated = $request->validated();

        $assesmentResponse->update($validated);

        return new AssesmentResponseResource($assesmentResponse);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AssesmentResponse $assesmentResponse
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        AssesmentResponse $assesmentResponse
    ) {
        $this->authorize('delete', $assesmentResponse);

        $assesmentResponse->delete();

        return response()->noContent();
    }
}
