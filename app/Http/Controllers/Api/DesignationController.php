<?php

namespace App\Http\Controllers\Api;

use App\Models\Designation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DesignationResource;
use App\Http\Resources\DesignationCollection;
use App\Http\Requests\DesignationStoreRequest;
use App\Http\Requests\DesignationUpdateRequest;

class DesignationController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Designation::class);

        $search = $request->get('search', '');

        $designations = Designation::search($search)
            ->latest()
            ->paginate();

        return new DesignationCollection($designations);
    }

    /**
     * @param \App\Http\Requests\DesignationStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(DesignationStoreRequest $request)
    {
        $this->authorize('create', Designation::class);

        $validated = $request->validated();

        $designation = Designation::create($validated);

        return new DesignationResource($designation);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Designation $designation
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Designation $designation)
    {
        $this->authorize('view', $designation);

        return new DesignationResource($designation);
    }

    /**
     * @param \App\Http\Requests\DesignationUpdateRequest $request
     * @param \App\Models\Designation $designation
     * @return \Illuminate\Http\Response
     */
    public function update(
        DesignationUpdateRequest $request,
        Designation $designation
    ) {
        $this->authorize('update', $designation);

        $validated = $request->validated();

        $designation->update($validated);

        return new DesignationResource($designation);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Designation $designation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Designation $designation)
    {
        $this->authorize('delete', $designation);

        $designation->delete();

        return response()->noContent();
    }
}
