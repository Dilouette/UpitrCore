<?php

namespace App\Http\Controllers\Api;

use App\Models\JobSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\JobSettingResource;
use App\Http\Resources\JobSettingCollection;
use App\Http\Requests\JobSettingStoreRequest;
use App\Http\Requests\JobSettingUpdateRequest;

class JobSettingController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', JobSetting::class);

        $search = $request->get('search', '');

        $jobSettings = JobSetting::search($search)
            ->latest()
            ->paginate();

        return new JobSettingCollection($jobSettings);
    }

    /**
     * @param \App\Http\Requests\JobSettingStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobSettingStoreRequest $request)
    {
        $this->authorize('create', JobSetting::class);

        $validated = $request->validated();

        $jobSetting = JobSetting::create($validated);

        return new JobSettingResource($jobSetting);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobSetting $jobSetting
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, JobSetting $jobSetting)
    {
        $this->authorize('view', $jobSetting);

        return new JobSettingResource($jobSetting);
    }

    /**
     * @param \App\Http\Requests\JobSettingUpdateRequest $request
     * @param \App\Models\JobSetting $jobSetting
     * @return \Illuminate\Http\Response
     */
    public function update(
        JobSettingUpdateRequest $request,
        JobSetting $jobSetting
    ) {
        $this->authorize('update', $jobSetting);

        $validated = $request->validated();

        $jobSetting->update($validated);

        return new JobSettingResource($jobSetting);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobSetting $jobSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, JobSetting $jobSetting)
    {
        $this->authorize('delete', $jobSetting);

        $jobSetting->delete();

        return response()->noContent();
    }
}
