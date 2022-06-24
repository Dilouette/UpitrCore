<?php

namespace App\Http\Controllers\Api;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\JobSettingResource;
use App\Http\Resources\JobSettingCollection;

class JobJobSettingsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Job $job
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Job $job)
    {
        $this->authorize('view', $job);

        $search = $request->get('search', '');

        $jobSettings = $job
            ->jobSettings()
            ->search($search)
            ->latest()
            ->paginate();

        return new JobSettingCollection($jobSettings);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Job $job
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Job $job)
    {
        $this->authorize('create', JobSetting::class);

        $validated = $request->validate([
            'firstname' => ['required', 'in:mandatory'],
            'lastname' => ['required', 'in:mandatory'],
            'email' => ['required', 'in:mandatory'],
            'phone' => ['required', 'in:mandatory,optional,off'],
            'heading' => ['required', 'in:mandatory,optional,off'],
            'address' => ['required', 'in:mandatory,optional,off'],
            'photo' => ['required', 'in:mandatory,optional,off'],
            'education' => ['required', 'in:optional,off'],
            'experience' => ['required', 'in:optional,off'],
            'summary' => ['required', 'in:mandatory,optional,off'],
            'resume' => ['required', 'in:mandatory,optional,off'],
            'cover_letter' => ['required', 'in:mandatory,optional,off'],
            'cv' => ['required', 'in:mandatory,optional,off'],
        ]);

        $jobSetting = $job->jobSettings()->create($validated);

        return new JobSettingResource($jobSetting);
    }
}
