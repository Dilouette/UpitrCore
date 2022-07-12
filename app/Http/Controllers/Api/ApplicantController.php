<?php

namespace App\Http\Controllers\Api;

use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ApplicantMoveRequest;
use App\Http\Resources\JobApplicantResource;
use App\Http\Requests\ApplicantBulkMoveRequest;
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

            $query->when($request->filled('keyword'), function ($q) use($request){
                return $q->whereHas('candidate', function ($q) use ($request) {
                    $q->where("firstname", "like", "%$request->keyword%")
                    ->orWhere("middlename", "like", "%$request->keyword%")
                    ->orWhere("lastname", "like", "%$request->keyword%")
                    ->orWhere("email", "like", "%$request->keyword%")
                    ->orWhere("phone", "like", "%$request->keyword%")
                    ->orWhere("skills", "like", "%$request->keyword%");
                });
            });    

            $query->when($request->filled('stage'), function ($q) use($request){
                return $q->where("job_workflow_stage_id", $request->stage);
            });

            $query->when($request->filled('gender'), function ($q) use($request){
                return $q->whereHas('candidate', function ($q) use ($request) {
                    $q->where("gender_id", $request->gender);
                });
            });

            $query->when($request->filled('industry'), function ($q) use($request){
                return $q->whereHas('candidate', function ($q) use ($request) {
                    $q->where("industry_id", $request->industry);
                });
            });

            $query->when($request->filled('job_function'), function ($q) use($request){
                return $q->whereHas('candidate', function ($q) use ($request) {
                    $q->where("job_function_id", $request->job_function);
                });
            });

            $query->when(($request->filled('dob_start') && $request->filled('dob_end')), function ($q) use($request){
                return $q->whereHas('candidate', function ($q) use ($request) {
                    $q->whereBetween('dob', [$request->date('dob_start'), $request->date('dob_end')]);
                });
            });

            $query->when(($request->filled('exp_min') && $request->filled('exp_max')), function ($q) use($request){
                return $q->whereHas('candidate', function ($q) use ($request) {
                    $q->whereBetween('years_of_experience', [$request->exp_min, $request->exp_max]);
                });
            });

            $query->when($request->filled('degree_class'), function ($q) use($request){
                return $q->whereHas('candidate', function ($q) use ($request) {
                    return $q->whereHas('educations', function ($q) use ($request) {
                        $q->where('degree_classification_id', $request->degree_class);
                    });
                });                
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
     * @param \App\Http\Requests\ApplicantBulkMoveRequest $request
     * @param \App\Models\Applicant $applicant
     * @return \Illuminate\Http\Response
     */
    public function bulkMove(ApplicantBulkMoveRequest $request) {

        try {
            
            $validated = $request->validated();

            Applicant::whereIn('id', $validated['applicants'])
                  ->update(['job_workflow_stage_id' => $validated['job_workflow_stage_id']]);

            return $this->success($validated['applicants']);
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
