<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ExperienceLevel;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExperienceLevelResource;
use App\Http\Resources\ExperienceLevelCollection;
use App\Http\Requests\ExperienceLevelStoreRequest;
use App\Http\Requests\ExperienceLevelUpdateRequest;

class ExperienceLevelController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', ExperienceLevel::class);

        $search = $request->get('search', '');

        $experienceLevels = ExperienceLevel::search($search)
            ->latest()
            ->paginate();

        return new ExperienceLevelCollection($experienceLevels);
    }

    /**
     * @param \App\Http\Requests\ExperienceLevelStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExperienceLevelStoreRequest $request)
    {
        $this->authorize('create', ExperienceLevel::class);

        $validated = $request->validated();

        $experienceLevel = ExperienceLevel::create($validated);

        return new ExperienceLevelResource($experienceLevel);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ExperienceLevel $experienceLevel
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ExperienceLevel $experienceLevel)
    {
        $this->authorize('view', $experienceLevel);

        return new ExperienceLevelResource($experienceLevel);
    }

    /**
     * @param \App\Http\Requests\ExperienceLevelUpdateRequest $request
     * @param \App\Models\ExperienceLevel $experienceLevel
     * @return \Illuminate\Http\Response
     */
    public function update(
        ExperienceLevelUpdateRequest $request,
        ExperienceLevel $experienceLevel
    ) {
        $this->authorize('update', $experienceLevel);

        $validated = $request->validated();

        $experienceLevel->update($validated);

        return new ExperienceLevelResource($experienceLevel);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ExperienceLevel $experienceLevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ExperienceLevel $experienceLevel)
    {
        $this->authorize('delete', $experienceLevel);

        $experienceLevel->delete();

        return response()->noContent();
    }
}
