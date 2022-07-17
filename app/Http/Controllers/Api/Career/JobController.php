<?php

namespace App\Http\Controllers\Api\Career;

use Carbon\Carbon;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\JobResource;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\JobStoreRequest;
use App\Http\Requests\JobUpdateRequest;
use App\Http\Controllers\Api\ServiceController;

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

            $query = Job::query()->where('is_published', true)->where('deadline', '>', Carbon::now())
                ->orderby('id', 'desc');

            $query->when($request->filled('keyword'), function ($q) use($request){
                Log::info($request->keyword);
                return $q->where("title", "like", "%$request->keyword%")
                         ->orWhere("description", "like", "%$request->keyword%")
                         ->orWhere("code", "like", "%$request->keyword%");
            });

            $query->when(($request->filled('deadline_start') && $request->filled('deadline_end')), function ($q) use($request){
                return $q->orWhereBetween('deadline', [$request->date('deadline_start'), $request->date('deadline_start')]);
            });

            $query->when($request->filled('department'), function ($q) use($request){
                return $q->where("department_id", $request->department);
            });

            $jobs = $query->paginate($page_size)->makeHidden(['user', 'jobQuestions', 'jobSettings', 'jobWorkflow', 'assesments', 'interviews']);       

            return $this->success($jobs);
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
            $job  = Job::find($id)->makeHidden(['user', 'jobQuestions', 'jobSettings', 'jobWorkflow', 'assesments', 'interviews']);
            if (!$job) {
                return $this->not_found();
            }
            return $this->success(new JobResource($job));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }
}
