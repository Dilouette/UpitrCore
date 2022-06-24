<?php

namespace App\Http\Controllers\Api;

use App\Models\Assesment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AssesmentResource;
use App\Http\Resources\AssesmentCollection;
use App\Http\Requests\AssesmentStoreRequest;
use App\Http\Requests\AssesmentUpdateRequest;

class AssesmentController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Assesment::class);

        $search = $request->get('search', '');

        $assesments = Assesment::search($search)
            ->latest()
            ->paginate();

        return new AssesmentCollection($assesments);
    }

    /**
     * @param \App\Http\Requests\AssesmentStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssesmentStoreRequest $request)
    {
        $this->authorize('create', Assesment::class);

        $validated = $request->validated();

        $assesment = Assesment::create($validated);

        return new AssesmentResource($assesment);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Assesment $assesment
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Assesment $assesment)
    {
        $this->authorize('view', $assesment);

        return new AssesmentResource($assesment);
    }

    /**
     * @param \App\Http\Requests\AssesmentUpdateRequest $request
     * @param \App\Models\Assesment $assesment
     * @return \Illuminate\Http\Response
     */
    public function update(
        AssesmentUpdateRequest $request,
        Assesment $assesment
    ) {
        $this->authorize('update', $assesment);

        $validated = $request->validated();

        $assesment->update($validated);

        return new AssesmentResource($assesment);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Assesment $assesment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Assesment $assesment)
    {
        $this->authorize('delete', $assesment);

        $assesment->delete();

        return response()->noContent();
    }
}
