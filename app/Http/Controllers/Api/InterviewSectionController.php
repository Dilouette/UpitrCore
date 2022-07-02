<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\InterviewSection;
use App\Http\Controllers\Controller;
use App\Http\Resources\InterviewSectionResource;
use App\Http\Resources\InterviewSectionCollection;
use App\Http\Requests\InterviewSectionStoreRequest;
use App\Http\Requests\InterviewSectionUpdateRequest;

class InterviewSectionController extends ServiceController
{
    
    /**
     * @param \App\Http\Requests\InterviewSectionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(InterviewSectionStoreRequest $request)
    {
        try {
            
            $validated = $request->validated();
            $interviewSection = InterviewSection::create($validated);

            return $this->success(new InterviewSectionResource($interviewSection));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        } 
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\InterviewSectionResource $interviewSectionResource
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $section = InterviewSection::find($id);
            if (!$section) {
                return $this->not_found();
            }

            return $this->success(new InterviewSectionResource($section));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }


    /**
     * @param \App\Http\Requests\InterviewSectionStoreRequest $request
     * @param \App\Models\InterviewSection $interviewSection
     * @return \Illuminate\Http\Response
     */
    public function update(InterviewSectionUpdateRequest $request, $id) {
        try {
            $validated = $request->validated();
            $section = InterviewSection::find($id);
            if (!$section) {
                return $this->not_found();
            }
            $section->update($validated);

            return $this->success(new InterviewSectionResource($section));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\InterviewSection $interviewSection
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            $section  = InterviewSection::find($id);
            if (!$section) {
                return $this->not_found();
            }

            $section->delete();
            return $this->success();

        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }
}
