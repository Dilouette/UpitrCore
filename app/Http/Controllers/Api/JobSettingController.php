<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\JobSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\JobSettingResource;
use App\Http\Resources\JobSettingCollection;
use App\Http\Requests\JobSettingStoreRequest;
use App\Http\Requests\JobSettingUpdateRequest;

class JobSettingController extends ServiceController
{
    /**
     * @param \App\Http\Requests\JobSettingStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobSettingStoreRequest $request)
    {
        try {
            $validated = $request->validated();
            $validated['created_at'] = Carbon::now();

            $jobSetting = JobSetting::create($validated);
            
            return $this->success(new JobSettingResource($jobSetting));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
        
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobSetting $jobSetting
     * @return \Illuminate\Http\Response
     */
    public function show($job_id)
    {
        try {
            $jobSetting  = JobSetting::where('job_id',$job_id)->first();
            if (!$jobSetting) {
                return $this->not_found();
            }
            return $this->success(new JobSettingResource($jobSetting));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }        
    }

    /**
     * @param \App\Http\Requests\JobSettingUpdateRequest $request
     * @param \App\Models\JobSetting $jobSetting
     * @return \Illuminate\Http\Response
     */
    public function update(JobSettingUpdateRequest $request, $job_id) {      

        try {
            $validated = $request->validated();
            $validated['updated_at'] = Carbon::now();

            $jobSetting  = JobSetting::where('job_id',$job_id)->first();
            if (!$jobSetting) {
                return $this->not_found();
            }

            $jobSetting->update($validated);
            
            return $this->success(new JobSettingResource($jobSetting));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }
}
