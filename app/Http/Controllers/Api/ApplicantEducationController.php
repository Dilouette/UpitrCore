<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ApplicantEducation;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApplicantEducationResource;
use App\Http\Resources\ApplicantEducationCollection;
use App\Http\Requests\ApplicantEducationStoreRequest;
use App\Http\Requests\ApplicantEducationUpdateRequest;

class ApplicantEducationController extends ServiceController
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index($applicant_id)
    {
        try {
            $applicantEducations = ApplicantEducation::where('job_applicant_id',$applicant_id)->orderBy('id', 'asc')->get();

            return $this->success(new ApplicantEducationCollection($applicantEducations));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }

    /**
     * @param \App\Http\Requests\ApplicantEducationStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApplicantEducationStoreRequest $request)
    {
        try {
            
            $validated = $request->validated();
            $applicantEducation = ApplicantEducation::create($validated);

            return $this->success(new ApplicantEducationResource($applicantEducation));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        } 
    }

    /**
     * @param \App\Http\Requests\ApplicantEducationUpdateRequest $request
     * @param \App\Models\ApplicantEducation $applicantEducation
     * @return \Illuminate\Http\Response
     */
    public function update(ApplicantEducationUpdateRequest $request, $id) {
        try {
            $validated = $request->validated();
            $applicantEducation = ApplicantEducation::find($id);
            if (!$applicantEducation) {
                return $this->not_found();
            }
            $applicantEducation->update($validated);

            return $this->success(new ApplicantEducationResource($applicantEducation));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ApplicantEducation $applicantEducation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $applicantEducation = ApplicantEducation::find($id);
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

