<?php

namespace App\Http\Controllers\Api\Career;

use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Resources\CandidateEducationResource;
use App\Http\Requests\CandidateEducationStoreRequest;
use App\Http\Requests\CandidateEducationUpdateRequest;

class CandidateEducationController extends ServiceController
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

            $education = Education::where('candidate_id',$candidate->id)
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
            $validated['candidate_id'] = Auth::guard('api-career')->user()->id;

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

            if ($education->candidate_id != Auth::guard('api-career')->user()->id) {
                return $this->not_found();
            }

            return $this->success(new CandidateEducationResource($education));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }

    /**
     * @param \App\Http\Requests\CandidateEducationUpdateRequest $request
     * @param \App\Models\Education $education
     * @return \Illuminate\Http\Response
     */
    public function update(CandidateEducationUpdateRequest $request, $id) {
        try {
            $validated = $request->validated();
            $education = Education::find($id);
            if (!$education) {
                return $this->not_found();
            }

            if ($education->candidate_id != Auth::guard('api-career')->user()->id) {
                return $this->forbidden(null, "You are not allowed to update another candidate's education.");
            }

            $education->update($validated);

            return $this->success(new CandidateEducationResource($education));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Education $education
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $education = Education::find($id);
            if (!$education) {
                return $this->not_found();
            }

            if ($education->candidate_id != Auth::guard('api-career')->user()->id) {
                return $this->forbidden(null, "You are not allowed to delete another candidate's education.");
            }

            $education->delete();
            return $this->success();

        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }
}

