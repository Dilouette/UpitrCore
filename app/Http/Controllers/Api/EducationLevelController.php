<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\EducationLevel;
use App\Http\Controllers\Controller;
use App\Http\Resources\EducationLevelResource;
use App\Http\Resources\EducationLevelCollection;
use App\Http\Requests\EducationLevelStoreRequest;
use App\Http\Requests\EducationLevelUpdateRequest;

class EducationLevelController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', EducationLevel::class);

        $search = $request->get('search', '');

        $educationLevels = EducationLevel::search($search)
            ->latest()
            ->paginate();

        return new EducationLevelCollection($educationLevels);
    }

    /**
     * @param \App\Http\Requests\EducationLevelStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EducationLevelStoreRequest $request)
    {
        $this->authorize('create', EducationLevel::class);

        $validated = $request->validated();

        $educationLevel = EducationLevel::create($validated);

        return new EducationLevelResource($educationLevel);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\EducationLevel $educationLevel
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, EducationLevel $educationLevel)
    {
        $this->authorize('view', $educationLevel);

        return new EducationLevelResource($educationLevel);
    }

    /**
     * @param \App\Http\Requests\EducationLevelUpdateRequest $request
     * @param \App\Models\EducationLevel $educationLevel
     * @return \Illuminate\Http\Response
     */
    public function update(
        EducationLevelUpdateRequest $request,
        EducationLevel $educationLevel
    ) {
        $this->authorize('update', $educationLevel);

        $validated = $request->validated();

        $educationLevel->update($validated);

        return new EducationLevelResource($educationLevel);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\EducationLevel $educationLevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, EducationLevel $educationLevel)
    {
        $this->authorize('delete', $educationLevel);

        $educationLevel->delete();

        return response()->noContent();
    }
}
