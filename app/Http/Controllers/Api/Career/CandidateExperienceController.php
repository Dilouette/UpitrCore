<?php

namespace App\Http\Controllers\Api\Career;

use App\Models\Experience;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Resources\CandidateExperienceResource;
use App\Http\Requests\CandidateExperienceStoreRequest;
use App\Http\Requests\CandidateExperienceUpdateRequest;

class CandidateExperienceController extends ServiceController
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $candidate = Auth::guard('api-career')->user();
            $page_size = env('DEFAULT_PAGE_SIZE');

            if ($request->filled('page_size')) {
                $page_size = $request->page_size;
            }

            $experiences = Experience::where('candidate_id', $candidate->id)
            ->orderBy('start_date', 'desc')->paginate($page_size);            

            return $this->success($experiences);
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }

    /**
     * @param \App\Http\Requests\CandidateExperienceStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CandidateExperienceStoreRequest $request)
    {
        try {            
            $validated = $request->validated();
            $validated['candidate_id'] = Auth::guard('api-career')->user()->id;

            $experience = Experience::create($validated);

            return $this->success(new CandidateExperienceResource($experience));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        } 
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Education $experience
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $experience  = Experience::find($id);
            if (!$experience) {
                return $this->not_found();
            }

            return $this->success(new CandidateExperienceResource($experience));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }

    /**
     * @param \App\Http\Requests\CandidateExperienceUpdateRequest $request
     * @param \App\Models\Experience $applicantExperience
     * @return \Illuminate\Http\Response
     */
    public function update(CandidateExperienceUpdateRequest $request, $id) {

        try {
            $validated = $request->validated();
            $experience = Experience::find($id);
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

            return $this->success(new CandidateExperienceResource($experience));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
        
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Experience $applicantExperience
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $experience = Experience::find($id);
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
