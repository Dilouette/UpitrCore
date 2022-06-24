<?php

namespace App\Http\Controllers\Api;

use App\Models\JobWorkflow;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\JobWorkflowStageResource;
use App\Http\Resources\JobWorkflowStageCollection;

class JobWorkflowJobWorkflowStagesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobWorkflow $jobWorkflow
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, JobWorkflow $jobWorkflow)
    {
        $this->authorize('view', $jobWorkflow);

        $search = $request->get('search', '');

        $jobWorkflowStages = $jobWorkflow
            ->jobWorkflowStages()
            ->search($search)
            ->latest()
            ->paginate();

        return new JobWorkflowStageCollection($jobWorkflowStages);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobWorkflow $jobWorkflow
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, JobWorkflow $jobWorkflow)
    {
        $this->authorize('create', JobWorkflowStage::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'description' => ['required', 'max:255', 'string'],
            'order' => ['required', 'max:255'],
            'stage_type_id' => ['required', 'max:255'],
        ]);

        $jobWorkflowStage = $jobWorkflow
            ->jobWorkflowStages()
            ->create($validated);

        return new JobWorkflowStageResource($jobWorkflowStage);
    }
}
