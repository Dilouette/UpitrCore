<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\JobWorkflowStage;
use App\Http\Controllers\Controller;
use App\Http\Resources\JobWorkflowStageResource;
use App\Http\Resources\JobWorkflowStageCollection;
use App\Http\Requests\JobWorkflowStageStoreRequest;
use App\Http\Requests\JobWorkflowStageUpdateRequest;

class JobWorkflowStageController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', JobWorkflowStage::class);

        $search = $request->get('search', '');

        $jobWorkflowStages = JobWorkflowStage::search($search)
            ->latest()
            ->paginate();

        return new JobWorkflowStageCollection($jobWorkflowStages);
    }

    /**
     * @param \App\Http\Requests\JobWorkflowStageStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobWorkflowStageStoreRequest $request)
    {
        $this->authorize('create', JobWorkflowStage::class);

        $validated = $request->validated();

        $jobWorkflowStage = JobWorkflowStage::create($validated);

        return new JobWorkflowStageResource($jobWorkflowStage);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobWorkflowStage $jobWorkflowStage
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, JobWorkflowStage $jobWorkflowStage)
    {
        $this->authorize('view', $jobWorkflowStage);

        return new JobWorkflowStageResource($jobWorkflowStage);
    }

    /**
     * @param \App\Http\Requests\JobWorkflowStageUpdateRequest $request
     * @param \App\Models\JobWorkflowStage $jobWorkflowStage
     * @return \Illuminate\Http\Response
     */
    public function update(
        JobWorkflowStageUpdateRequest $request,
        JobWorkflowStage $jobWorkflowStage
    ) {
        $this->authorize('update', $jobWorkflowStage);

        $validated = $request->validated();

        $jobWorkflowStage->update($validated);

        return new JobWorkflowStageResource($jobWorkflowStage);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobWorkflowStage $jobWorkflowStage
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        JobWorkflowStage $jobWorkflowStage
    ) {
        $this->authorize('delete', $jobWorkflowStage);

        $jobWorkflowStage->delete();

        return response()->noContent();
    }
}
