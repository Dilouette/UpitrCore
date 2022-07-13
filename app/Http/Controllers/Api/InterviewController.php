<?php

namespace App\Http\Controllers\Api;

use App\Models\Interview;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\InterviewResource;
use App\Http\Resources\InterviewCollection;
use App\Http\Requests\InterviewStoreRequest;
use App\Http\Requests\InterviewUpdateRequest;

class InterviewController extends ServiceController
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $interview = Interview::find($id);

            if(!$interview){
                return $this->not_found();
            }

            $interview->load('interviewSections');

            return $this->success(new InterviewResource($interview));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }
}
