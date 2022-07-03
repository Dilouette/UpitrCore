<?php

namespace App\Http\Controllers\Api;

use App\Models\Assesment;
use Illuminate\Http\Request;
use App\Http\Resources\AssesmentResource;
use App\Http\Resources\AssesmentCollection;
use App\Http\Requests\AssesmentStoreRequest;
use App\Http\Requests\AssesmentUpdateRequest;

class AssesmentController extends ServiceController
{
    
    /**
     * @param \App\Http\Requests\AssesmentStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssesmentStoreRequest $request)
    {
        try {
            $assessment  = Assesment::where('job_id', $request->job_id)->first();
            if ($assessment) {
                return $this->duplicate();
            }
            $validated = $request->validated();
            $assesment = Assesment::create($validated);
            return $this->success(new AssesmentResource($assesment));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
        
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Assesment $assesment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $assessment  = Assesment::find($id);
            if (!$assessment) {
                return $this->not_found();
            }

            $assessment->load(
                'assesmentQuestions',
            );

            return $this->success(new AssesmentResource($assessment));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }

    /**
     * @param \App\Http\Requests\AssesmentUpdateRequest $request
     * @param \App\Models\Assesment $assesment
     * @return \Illuminate\Http\Response
     */
    public function update(AssesmentUpdateRequest $request, $id) {
        try {
            $validated = $request->validated();
            $assesment = Assesment::find($id);
            if (!$assesment) {
                return $this->not_found();
            }
            $assesment->update($validated);
            return $this->success(new AssesmentResource($assesment));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }
}
