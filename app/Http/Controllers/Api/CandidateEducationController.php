<?php

namespace App\Http\Controllers\Api;

use App\Models\Education;
use Illuminate\Http\Request;
use App\Http\Resources\CandidateEducationResource;
use App\Http\Resources\CandidateEducationCollection;
use App\Http\Requests\CandidateEducationStoreRequest;
use App\Http\Requests\CandidateEducationUpdateRequest;

class CandidateEducationController extends ServiceController
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $candidate_id)
    {
        try {
            $page_size = env('DEFAULT_PAGE_SIZE');

            if ($request->filled('page_size')) {
                $page_size = $request->page_size;
            }

            $education = Education::where('candidate_id',$candidate_id)
            ->orderBy('start_date', 'desc')->paginate($page_size);

            return $this->success($education);
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }

    /**
     * @param \App\Http\Requests\CandidateEducationStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CandidateEducationStoreRequest $request)
    {
        try {
            
            $validated = $request->validated();
            $applicant = Education::create($validated);

            return $this->success(new CandidateEducationResource($applicant));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        } 
    }

     /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Education $education
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $education  = Education::find($id);
            if (!$education) {
                return $this->not_found();
            }

            return $this->success(new CandidateEducationResource($education));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }

    /**
     * @param \App\Http\Requests\CandidateEducationUpdateRequest $request
     * @param \App\Models\Education $applicantEducation
     * @return \Illuminate\Http\Response
     */
    public function update(CandidateEducationUpdateRequest $request, $id) {
        try {
            $validated = $request->validated();
            $applicantEducation = Education::find($id);
            if (!$applicantEducation) {
                return $this->not_found();
            }
            $applicantEducation->update($validated);

            return $this->success(new CandidateEducationResource($applicantEducation));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Education $applicantEducation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $applicantEducation = Education::find($id);
            if (!$applicantEducation) {
                return $this->not_found();
            }

            $applicantEducation->delete();
            return $this->success();

        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }
}

