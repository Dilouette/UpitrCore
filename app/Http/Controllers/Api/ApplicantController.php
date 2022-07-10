<?php

namespace App\Http\Controllers\Api;

use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\JobApplicantResource;
use App\Http\Requests\ApplicantMoveRequest;
use App\Http\Requests\JobApplicantStoreRequest;
use App\Http\Requests\JobApplicantUpdateRequest;

class ApplicantController extends ServiceController
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $vacancy_id)
    {
        try {

            $page_size = env('DEFAULT_PAGE_SIZE');

            if ($request->filled('page_size')) {
                $page_size = $request->page_size;
            }

            $query = Applicant::query()
                ->where('job_id', $vacancy_id)
                ->orderby('id', 'desc');

            $query->when($request->filled('stage'), function ($q) use($request){
                return $q->where("job_workflow_stage_id", $request->stage);
            });

            $applicants = $page_size == '*' ? $query->get() : $query->paginate($page_size);

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

            $applicant = Applicant::create($validated);

            $applicant->makeHidden([
                'job_id',
                'job_workflow_stage_id',        
            ]);  

            $applicant->load(
                'job', 
                'applicantExperiences', 
                'applicantEducations', 
                'jobWorkflowStage', 
                'applicantResponses', 
            );
            
            return $this->success($applicant);
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }        
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Applicant $applicant
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $applicant  = Applicant::find($id);
            if (!$applicant) {
                return $this->not_found();
            }

            return $this->success(new JobApplicantResource($applicant));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }

        /**
     * @param \App\Http\Requests\ApplicantMoveRequest $request
     * @param \App\Models\Applicant $applicant
     * @return \Illuminate\Http\Response
     */
    public function move(ApplicantMoveRequest $request, $id) {

        try {
            $applicant  = Applicant::find($id);

            if (!$applicant) {
                return $this->not_found();
            }

            $validated = $request->validated();
            $applicant->update($validated);    
            
            $applicant  = Applicant::find($id);

            return $this->success(new JobApplicantResource($applicant));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        } 
        
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Applicant $applicant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Applicant $applicant)
    {
        $this->authorize('delete', $applicant);

        if ($applicant->photo) {
            Storage::delete($applicant->photo);
        }

        $applicant->delete();

        return response()->noContent();
    }
}
