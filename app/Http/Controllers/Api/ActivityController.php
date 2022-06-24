<?php

namespace App\Http\Controllers\Api;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\ActivityCollection;
use App\Http\Requests\ActivityStoreRequest;
use App\Http\Requests\ActivityUpdateRequest;

class ActivityController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Activity::class);

        $search = $request->get('search', '');

        $activities = Activity::search($search)
            ->latest()
            ->paginate();

        return new ActivityCollection($activities);
    }

    /**
     * @param \App\Http\Requests\ActivityStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActivityStoreRequest $request)
    {
        $this->authorize('create', Activity::class);

        $validated = $request->validated();

        $activity = Activity::create($validated);

        return new ActivityResource($activity);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Activity $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Activity $activity)
    {
        $this->authorize('view', $activity);

        return new ActivityResource($activity);
    }

    /**
     * @param \App\Http\Requests\ActivityUpdateRequest $request
     * @param \App\Models\Activity $activity
     * @return \Illuminate\Http\Response
     */
    public function update(ActivityUpdateRequest $request, Activity $activity)
    {
        $this->authorize('update', $activity);

        $validated = $request->validated();

        $activity->update($validated);

        return new ActivityResource($activity);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Activity $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Activity $activity)
    {
        $this->authorize('delete', $activity);

        $activity->delete();

        return response()->noContent();
    }
}
