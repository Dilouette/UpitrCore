<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ApplicantExperience;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApplicantExperienceResource;
use App\Http\Resources\ApplicantExperienceCollection;
use App\Http\Requests\ApplicantExperienceStoreRequest;
use App\Http\Requests\ApplicantExperienceUpdateRequest;

class ApplicantExperienceController extends ServiceController
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index($applicant_id)
    {
        try {
            $applicantExperiences = ApplicantExperience::where('job_applicant_id', $applicant_id)->orderBy('id', 'desc')->get();
            

            $applicantExperiences->makeHidden([
                'industry_id',             
            ]);

            $applicantExperiences->load(
                'industry', 
            );
            
            return $this->success(new ApplicantExperienceCollection($applicantExperiences));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }

    /**
     * @param \App\Http\Requests\ApplicantExperienceStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApplicantExperienceStoreRequest $request)
    {
        try {
            
            $validated = $request->validated();
            $applicantExperience = ApplicantExperience::create($validated);

            $applicantExperience->makeHidden([
                'industry_id',             
            ]);

            $applicantExperience->load(
                'industry', 
            );

            return $this->success(new ApplicantExperienceResource($applicantExperience));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        } 
    }

    /**
     * @param \App\Http\Requests\ApplicantExperienceUpdateRequest $request
     * @param \App\Models\ApplicantExperience $applicantExperience
     * @return \Illuminate\Http\Response
     */
    public function update(ApplicantExperienceUpdateRequest $request, $id) {

        try {
            $validated = $request->validated();
            $experience = ApplicantExperience::find($id);
            if (!$experience) {
                return $this->not_found();
            }
            $experience->update($validated);

            $experience->makeHidden([
                'industry_id',             
            ]);

            $experience->load(
                'industry', 
            );

            return $this->success(new ApplicantExperienceResource($experience));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
        
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ApplicantExperience $applicantExperience
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $experience = ApplicantExperience::find($id);
            if (!$experience) {
                return $this->not_found();
            }

            $experience->delete();
            return $this->success();

        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }
}
