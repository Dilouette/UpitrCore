<?php

namespace App\Http\Controllers\Api;

use Throwable;
use Illuminate\Http\Request;
use App\Models\InterviewQuestion;
use App\Http\Resources\InterviewQuestionResource;
use App\Http\Requests\InterviewQuestionStoreRequest;
use App\Http\Requests\InterviewQuestionUpdateRequest;

class InterviewQuestionController extends ServiceController
{

    /**
     * @param \App\Http\Requests\InteviewQuestionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(InterviewQuestionStoreRequest $request)
    {
        try {
            $validated = $request->validated();
            $interviewQuestion = InterviewQuestion::create($validated);
            return $this->success(new InterviewQuestionResource($interviewQuestion));
        } catch (Throwable $th) {
            return $this->server_error($th);
        }        
    }

    /**
     * @param \App\Http\Requests\InteviewQuestionUpdateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(InterviewQuestionUpdateRequest $request, $id)
    {
        try {
            $validated = $request->validated();
            
            $question  = InterviewQuestion::find($id);
            if (!$question) {
                return $this->not_found();
            }

            $question->update($validated);

            return $this->success(new InterviewQuestionResource($question));
        } catch (Throwable $th) {
            return $this->server_error($th);
        }        
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\InteviewQuestion $inteviewQuestion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            $question  = InterviewQuestion::find($id);
            if (!$question) {
                return $this->not_found();
            }
            $question->delete();
            return $this->success();
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }
}
