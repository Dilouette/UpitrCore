<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\EmploymentType;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmploymentTypeResource;
use App\Http\Resources\EmploymentTypeCollection;
use App\Http\Requests\EmploymentTypeStoreRequest;
use App\Http\Requests\EmploymentTypeUpdateRequest;

class EmploymentTypeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', EmploymentType::class);

        $search = $request->get('search', '');

        $employmentTypes = EmploymentType::search($search)
            ->latest()
            ->paginate();

        return new EmploymentTypeCollection($employmentTypes);
    }

    /**
     * @param \App\Http\Requests\EmploymentTypeStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmploymentTypeStoreRequest $request)
    {
        $this->authorize('create', EmploymentType::class);

        $validated = $request->validated();

        $employmentType = EmploymentType::create($validated);

        return new EmploymentTypeResource($employmentType);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\EmploymentType $employmentType
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, EmploymentType $employmentType)
    {
        $this->authorize('view', $employmentType);

        return new EmploymentTypeResource($employmentType);
    }

    /**
     * @param \App\Http\Requests\EmploymentTypeUpdateRequest $request
     * @param \App\Models\EmploymentType $employmentType
     * @return \Illuminate\Http\Response
     */
    public function update(
        EmploymentTypeUpdateRequest $request,
        EmploymentType $employmentType
    ) {
        $this->authorize('update', $employmentType);

        $validated = $request->validated();

        $employmentType->update($validated);

        return new EmploymentTypeResource($employmentType);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\EmploymentType $employmentType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, EmploymentType $employmentType)
    {
        $this->authorize('delete', $employmentType);

        $employmentType->delete();

        return response()->noContent();
    }
}
