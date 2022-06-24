<?php

namespace App\Http\Controllers\Api;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DepartmentResource;
use App\Http\Resources\DepartmentCollection;
use App\Http\Requests\DepartmentStoreRequest;
use App\Http\Requests\DepartmentUpdateRequest;

class DepartmentController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Department::class);

        $search = $request->get('search', '');

        $departments = Department::search($search)
            ->latest()
            ->paginate();

        return new DepartmentCollection($departments);
    }

    /**
     * @param \App\Http\Requests\DepartmentStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentStoreRequest $request)
    {
        $this->authorize('create', Department::class);

        $validated = $request->validated();

        $department = Department::create($validated);

        return new DepartmentResource($department);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Department $department
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Department $department)
    {
        $this->authorize('view', $department);

        return new DepartmentResource($department);
    }

    /**
     * @param \App\Http\Requests\DepartmentUpdateRequest $request
     * @param \App\Models\Department $department
     * @return \Illuminate\Http\Response
     */
    public function update(
        DepartmentUpdateRequest $request,
        Department $department
    ) {
        $this->authorize('update', $department);

        $validated = $request->validated();

        $department->update($validated);

        return new DepartmentResource($department);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Department $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Department $department)
    {
        $this->authorize('delete', $department);

        $department->delete();

        return response()->noContent();
    }
}
