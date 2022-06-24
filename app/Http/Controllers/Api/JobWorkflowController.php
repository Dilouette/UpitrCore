<?php

namespace App\Http\Controllers\Api;

use App\Models\JobWorkflow;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\JobWorkflowResource;
use App\Http\Resources\JobWorkflowCollection;
use App\Http\Requests\JobWorkflowStoreRequest;
use App\Http\Requests\JobWorkflowUpdateRequest;

class JobWorkflowController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', JobWorkflow::class);

        $search = $request->get('search', '');

        $jobWorkflows = JobWorkflow::search($search)
            ->latest()
            ->paginate();

        return new JobWorkflowCollection($jobWorkflows);
    }

    /**
     * @param \App\Http\Requests\JobWorkflowStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobWorkflowStoreRequest $request)
    {
        $this->authorize('create', JobWorkflow::class);

        $validated = $request->validated();

        $jobWorkflow = JobWorkflow::create($validated);

        return new JobWorkflowResource($jobWorkflow);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobWorkflow $jobWorkflow
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, JobWorkflow $jobWorkflow)
    {
        $this->authorize('view', $jobWorkflow);

        return new JobWorkflowResource($jobWorkflow);
    }

    /**
     * @param \App\Http\Requests\JobWorkflowUpdateRequest $request
     * @param \App\Models\JobWorkflow $jobWorkflow
     * @return \Illuminate\Http\Response
     */
    public function update(
        JobWorkflowUpdateRequest $request,
        JobWorkflow $jobWorkflow
    ) {
        $this->authorize('update', $jobWorkflow);

        $validated = $request->validated();

        $jobWorkflow->update($validated);

        return new JobWorkflowResource($jobWorkflow);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobWorkflow $jobWorkflow
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, JobWorkflow $jobWorkflow)
    {
        $this->authorize('delete', $jobWorkflow);

        $jobWorkflow->delete();

        return response()->noContent();
    }
}
