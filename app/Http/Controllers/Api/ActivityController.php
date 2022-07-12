<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\ActivityCollection;
use App\Http\Requests\ActivityStoreRequest;
use App\Http\Requests\ActivityUpdateRequest;

class ActivityController extends ServiceController
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

            $query = Activity::query()
                ->orderby('id', 'desc');

            $query->when($request->filled('keyword'), function ($q) use($request){
                Log::info($request->keyword);
                return $q->where("title", "like", "%$request->keyword%")
                ->orWhere("location", "like", "%$request->keyword%")
                ->orWhere("description", "like", "%$request->keyword%");
            });

            $query->when(($request->filled('start') && $request->filled('end')), function ($q) use($request){
                return $q->orWhereBetween('start', [$request->date('start'), $request->date('end')]);
            });

            $query->when($request->filled('vacancy'), function ($q) use($request){
                return $q->where("job_id", $request->vacancy);
            });

            $query->when($request->filled('candidate'), function ($q) use($request){
                return $q->where("candidate_id", $request->candidate);
            });

            $query->when($request->filled('applicant'), function ($q) use($request){
                return $q->where("applicant_id", $request->applicant);
            });

            $activities = $query->paginate($page_size);
            $activities->load('job', 'applicant');

            return $this->success($activities);
        } catch (\Throwable $th) {
            return $this->server_error($th);
        } 
    }

    /**
     * @param \App\Http\Requests\ActivityStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActivityStoreRequest $request)
    {
        try {
            $validated = $request->validated();

            $validated['created_by'] = Auth::user()->id;
            $validated['created_at'] = Carbon::now();
            
            $activity = Activity::create($validated);

            foreach ($validated['assignees'] as $key => $value) {
                $activity->assignees()->attach($value);
            }

            $activity->load('job', 'applicant', 'creator', 'editor', 'assignees');
            
            return $this->success($activity);
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Activity $activity
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $activity  = Activity::find($id);
            if (!$activity) {
                return $this->not_found();
            }

            $activity->load('job', 'applicant', 'creator', 'editor', 'assignees');

            return $this->success(new ActivityResource($activity));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }

    /**
     * @param \App\Http\Requests\ActivityUpdateRequest $request
     * @param \App\Models\Activity $activity
     * @return \Illuminate\Http\Response
     */
    public function update(ActivityUpdateRequest $request, $id)
    {
        try {
            $validated = $request->validated();

            $activity  = Activity::find($id);
            if (!$activity) {
                return $this->not_found();
            }

            $validated['updated_by'] = Auth::user()->id;
            $validated['updated_at'] = Carbon::now();
            
            $activity->update($validated);
            $activity->assignees()->sync($validated['assignees']);

            $activity->load('job', 'applicant', 'creator', 'editor', 'assignees');
            
            return $this->success($activity);
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Activity $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $activity  = Activity::find($id);
            if (!$activity) {
                return $this->not_found();
            }

            $activity->assignees()->detach();
            $activity->delete();

            return $this->success();
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }
}
