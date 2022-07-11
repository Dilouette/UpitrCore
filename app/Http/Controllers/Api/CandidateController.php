<?php

namespace App\Http\Controllers\Api;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\JobApplicantResource;

class CandidateController extends ServiceController
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

            $query = Candidate::query()
                ->orderby('id', 'desc');
            
            $query->when($request->filled('degree_class'), function ($q) use($request){
                return $q->whereHas('educations', function ($q) use ($request) {
                    $q->where('degree_classification_id', $request->degree_class);
                });
            });

            $query->when($request->filled('gender'), function ($q) use($request){
                return $q->where("gender_id", $request->gender);
            });

            $query->when($request->filled('industry'), function ($q) use($request){
                return $q->where("industry_id", $request->industry);
            });

            $query->when($request->filled('job_function'), function ($q) use($request){
                return $q->where("job_function_id", $request->job_function);
            });

            $query->when(($request->filled('dob_start') && $request->filled('dob_end')), function ($q) use($request){
                return $q->whereBetween('dob', [$request->date('dob_start'), $request->date('dob_end')]);
            });

            $query->when(($request->filled('exp_min') && $request->filled('exp_max')), function ($q) use($request){
                return $q->whereBetween('years_of_experience', [$request->exp_min, $request->exp_max]);
            });

            $query->when($request->filled('keyword'), function ($q) use($request){
                return $q->where("firstname", "ilike", "%$request->keyword%")
                ->orWhere("middlename", "ilike", "%$request->keyword%")
                ->orWhere("lastname", "ilike", "%$request->keyword%")
                ->orWhere("email", "ilike", "%$request->keyword%")
                ->orWhere("phone", "ilike", "%$request->keyword%")
                ->orWhere("skills", "ilike", "%$request->keyword%");
            });            

            $candidates = $query->paginate($page_size);

            return $this->success($candidates);
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }      
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Candidate $candidate
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $candidate  = Candidate::find($id);
            if (!$candidate) {
                return $this->not_found();
            }

            return $this->success(new JobApplicantResource($candidate));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Applicant $applicant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $candidate  = Candidate::find($id);
            if (!$candidate) {
                return $this->not_found();
            }

            $candidate->delete();
            return $this->success();

        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }
}
