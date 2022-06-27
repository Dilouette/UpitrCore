<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Resources\JobResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\JobCollection;
use App\Http\Requests\JobStoreRequest;
use App\Http\Requests\JobUpdateRequest;

class JobController extends ServiceController
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            $page_size = env('DEFAULT_PAGE_SIZE');

            if ($request->filled('page_size')) {
                $page_size = $request->page_size;
            }

            $query = Job::query()
                ->orderby('id', 'desc');

            $jobs = $query->paginate($page_size);
            $jobs->load(
                'user', 
                'city', 
                'department', 
                'industry', 
                'jobFunction', 
                'employmentType',
                'experienceLevel', 
                'educationLevel', 
                'currency', 
                'jobWorkflow'
            );

            $jobs->makeHidden([
                'created_by',
                'country_id',
                'region_id',
                'city_id',
                'department_id',
                'industry_id',
                'job_function_id',
                'employment_type_id',
                'experience_level_id',
                'education_level_id',  
                'salary_currency_id',
                'job_workflow_id',                
            ]);           

            return $this->success($jobs);
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }        
    }

    /**
     * @param \App\Http\Requests\JobStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobStoreRequest $request)
    {
        try {
            $user = Auth::user();
            
            $validated = $request->validated();

            $validated['created_by'] = $user->id;
            $validated['is_published'] = false;
            $validated['job_workflow_id'] = 1;//Default workflow id

            $job = Job::create($validated);

            $job->makeHidden([
                'created_by',
                'country_id',
                'region_id',
                'city_id',
                'department_id',
                'industry_id',
                'job_function_id',
                'employment_type_id',
                'experience_level_id',
                'education_level_id',  
                'salary_currency_id',
                'job_workflow_id',                
            ]);

            $job->load(
                'user', 
                'city', 
                'department', 
                'industry', 
                'jobFunction', 
                'employmentType',
                'experienceLevel', 
                'educationLevel', 
                'currency', 
                'jobWorkflow'
            );

            return $this->created(new JobResource($job));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }        
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Job $job
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $job  = Job::find($id);
            if (!$job) {
                return $this->not_found();
            }

            $job->makeHidden([
                'created_by',
                'country_id',
                'region_id',
                'city_id',
                'department_id',
                'industry_id',
                'job_function_id',
                'employment_type_id',
                'experience_level_id',
                'education_level_id',  
                'salary_currency_id',
                'job_workflow_id',                
            ]);

            $job->load(
                'user', 
                'city', 
                'department', 
                'industry', 
                'jobFunction', 
                'employmentType',
                'experienceLevel', 
                'educationLevel', 
                'currency', 
                'jobWorkflow',
                'jobQuestions', 
                'jobSettings',
                'activities',
                'notes'
            );

            return $this->success(new JobResource($job));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Job $job
     * @return \Illuminate\Http\Response
     */
    public function publish($id)
    {
        try {
            $job  = Job::find($id);
            if (!$job) {
                return $this->not_found();
            }

            $job->is_published = true;
            $job->save();

            $job->makeHidden([
                'created_by',
                'country_id',
                'region_id',
                'city_id',
                'department_id',
                'industry_id',
                'job_function_id',
                'employment_type_id',
                'experience_level_id',
                'education_level_id',  
                'salary_currency_id',
                'job_workflow_id',                
            ]);

            $job->load(
                'user', 
                'city', 
                'department', 
                'industry', 
                'jobFunction', 
                'employmentType',
                'experienceLevel', 
                'educationLevel', 
                'currency', 
                'jobWorkflow'
            );

            return $this->success(new JobResource($job));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Job $job
     * @return \Illuminate\Http\Response
     */
    public function unpublish($id)
    {
        try {
            $job  = Job::find($id);
            if (!$job) {
                return $this->not_found();
            }

            $job->is_published = false;
            $job->save();

            $job->makeHidden([
                'created_by',
                'country_id',
                'region_id',
                'city_id',
                'department_id',
                'industry_id',
                'job_function_id',
                'employment_type_id',
                'experience_level_id',
                'education_level_id',  
                'salary_currency_id',
                'job_workflow_id',                
            ]);

            $job->load(
                'user', 
                'city', 
                'department', 
                'industry', 
                'jobFunction', 
                'employmentType',
                'experienceLevel', 
                'educationLevel', 
                'currency', 
                'jobWorkflow'
            );

            return $this->success(new JobResource($job));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }

    /**
     * @param \App\Http\Requests\JobUpdateRequest $request
     * @param \App\Models\Job $job
     * @return \Illuminate\Http\Response
     */
    public function update(JobUpdateRequest $request, $id)
    {
        try {
            $job  = Job::find($id);
            if (!$job) {
                return $this->not_found();
            }
            $validated = $request->validated();

            $validated['updated_at'] = Carbon::now();

            $job->update($validated);
            
            $job->makeHidden([
                'created_by',
                'country_id',
                'region_id',
                'city_id',
                'department_id',
                'industry_id',
                'job_function_id',
                'employment_type_id',
                'experience_level_id',
                'education_level_id',  
                'salary_currency_id',
                'job_workflow_id',                
            ]);

            $job->load(
                'user', 
                'city', 
                'department', 
                'industry', 
                'jobFunction', 
                'employmentType',
                'experienceLevel', 
                'educationLevel', 
                'currency', 
                'jobWorkflow'
            );

            return $this->success(new JobResource($job));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Job $job
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $job  = Job::find($id);
            if (!$job) {
                return $this->not_found();
            }

            $job->delete();
            return $this->success();

        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }
}
