<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\JobResource;
use Illuminate\Support\Facades\Log;
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

            $query->when($request->filled('keyword'), function ($q) use($request){
                return $q->where("title", "ilike", "%$request->keyword%")
                            ->orWhere("description", "ilike", "%$request->keyword%")
                            ->orWhere("code", "ilike", "%$request->keyword%");
            });

            $query->when(($request->filled('deadline_start') && $request->filled('deadline_end')), function ($q) use($request){
                return $q->orWhereBetween('deadline', [$request->date('deadline_start'), $request->date('deadline_start')]);
            });

            $query->when($request->filled('department'), function ($q) use($request){
                return $q->where("department_id", $request->department);
            });

            $jobs = $query->paginate($page_size);

            return $this->success($jobs);
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }        
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function active(Request $request)
    {
        try {

            $page_size = env('DEFAULT_PAGE_SIZE');

            if ($request->filled('page_size')) {
                $page_size = $request->page_size;
            }

            $query = Job::query()->where('is_published', true)->where('deadline', '>', Carbon::now())
                ->orderby('id', 'desc');

            $query->when($request->filled('keyword'), function ($q) use($request){
                Log::info($request->keyword);
                return $q->where("title", "ilike", "%$request->keyword%")
                         ->orWhere("description", "ilike", "%$request->keyword%")
                         ->orWhere("code", "ilike", "%$request->keyword%");
            });

            $query->when(($request->filled('deadline_start') && $request->filled('deadline_end')), function ($q) use($request){
                return $q->orWhereBetween('deadline', [$request->date('deadline_start'), $request->date('deadline_start')]);
            });

            $query->when($request->filled('department'), function ($q) use($request){
                return $q->where("department_id", $request->department);
            });

            $jobs = $query->paginate($page_size);       

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

            DB::beginTransaction();
            $job = Job::create($validated);

            $job->interviews()->create([
                'title' => $job->title . ' Interview',
                'job_id' => $job->id,
            ]);

            DB::commit();

            return $this->created(new JobResource($job));
        } catch (\Throwable $th) {
            DB::rollBack();
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
            $job->load('interviews');
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
