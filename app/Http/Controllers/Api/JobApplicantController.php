<?php

namespace App\Http\Controllers\Api;

use App\Models\JobApplicant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\JobApplicantResource;
use App\Http\Resources\JobApplicantCollection;
use App\Http\Requests\JobApplicantStoreRequest;
use App\Http\Requests\JobApplicantUpdateRequest;

class JobApplicantController extends ServiceController
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

            $query = JobApplicant::query()
                ->orderby('id', 'desc');

            $applicants = $query->paginate($page_size);
            $applicants->load(
                'job', 
                'jobWorkflowStage', 
            );

            $applicants->makeHidden([
                'job_id',
                'job_workflow_stage_id',        
            ]);           

            return $this->success($applicants);
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }      
    }

    /**
     * @param \App\Http\Requests\JobApplicantStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobApplicantStoreRequest $request)
    {
        try {
            $validated = $request->validated();
            if ($request->hasFile('photo')) {
                $validated['photo'] = $request->file('photo')->store('public');
            }
            if ($request->hasFile('resume')) {
                $validated['resume'] = $request->file('resume')->store('public');
            }
            if ($request->hasFile('cover_letter')) {
                $validated['cover_letter'] = $request->file('cover_letter')->store('public');
            }

            $validated['job_workflow_stage_id'] = 1; // TODO: Make the first stage of selected job
            $validated['consideration_id'] = 0; // TODO: Decide on what to do with consideration

            $jobApplicant = JobApplicant::create($validated);

            $jobApplicant->makeHidden([
                'job_id',
                'job_workflow_stage_id',        
            ]);  

            $jobApplicant->load(
                'job', 
                'applicantExperiences', 
                'applicantEducations', 
                'jobWorkflowStage', 
                'applicantResponses', 
            );
            
            return $this->success($jobApplicant);
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }        
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobApplicant $jobApplicant
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $jobApplicant  = JobApplicant::find($id);
            if (!$jobApplicant) {
                return $this->not_found();
            }

            $jobApplicant->makeHidden([
                'job_id',
                'job_workflow_stage_id',        
            ]);  

            $jobApplicant->load(
                'applicantExperiences', 
                'applicantEducations', 
                'applicantResponses', 
            );

            return $this->success(new JobApplicantResource($jobApplicant));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }

    /**
     * @param \App\Http\Requests\JobApplicantUpdateRequest $request
     * @param \App\Models\JobApplicant $jobApplicant
     * @return \Illuminate\Http\Response
     */
    public function update(JobApplicantUpdateRequest $request, $id) {

        try {
            $jobApplicant  = JobApplicant::find($id);

            if (!$jobApplicant) {
                return $this->not_found();
            }
            $validated = $request->validated();

            if ($request->hasFile('photo')) {
                if ($jobApplicant->photo) {
                    Storage::delete($jobApplicant->photo);
                }

                $validated['photo'] = $request->file('photo')->store('public');
            }

            if ($request->hasFile('resume')) {
                if ($jobApplicant->resume) {
                    Storage::delete($jobApplicant->resume);
                }

                $validated['resume'] = $request->file('resume')->store('public');
            }

            if ($request->hasFile('cover_letter')) {
                if ($jobApplicant->cover_letter) {
                    Storage::delete($jobApplicant->cover_letter);
                }

                $validated['cover_letter'] = $request->file('cover_letter')->store('public');
            }

            $jobApplicant->update($validated);

            $jobApplicant->makeHidden([
                'job_id',
                'job_workflow_stage_id',        
            ]);  

            $jobApplicant->load(
                'applicantExperiences', 
                'applicantEducations', 
                'applicantResponses', 
            );

            return $this->success(new JobApplicantResource($jobApplicant));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }        
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobApplicant $jobApplicant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, JobApplicant $jobApplicant)
    {
        $this->authorize('delete', $jobApplicant);

        if ($jobApplicant->photo) {
            Storage::delete($jobApplicant->photo);
        }

        $jobApplicant->delete();

        return response()->noContent();
    }
}
