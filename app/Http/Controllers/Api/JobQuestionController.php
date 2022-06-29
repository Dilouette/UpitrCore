<?php

namespace App\Http\Controllers\Api;

use App\Models\Job;
use App\Models\JobQuestion;
use Illuminate\Http\Request;
use App\Models\JobQuestionOption;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\JobQuestionResource;
use App\Http\Resources\JobQuestionCollection;
use App\Http\Requests\JobQuestionStoreRequest;
use App\Http\Requests\JobQuestionUpdateRequest;

use function PHPUnit\Framework\throwException;

class JobQuestionController extends ServiceController
{
   
    /**
     * @param \App\Http\Requests\JobQuestionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobQuestionStoreRequest $request)
    {
        try {        

            DB::beginTransaction();

            $validated = $request->validated();   
            $job  = Job::find($validated['job_id']);
            if (!$job) {
                return $this->not_found(null, null, "Vacancy not found");
            }             
            $jobQuestion = JobQuestion::create($validated);

            foreach($validated['question_options'] as $option){ 

                $newOption = new JobQuestionOption();

                $newOption->option = $option;
                $newOption->job_question_id = $jobQuestion->id;

                $newOption->save(); 
            }

            DB::commit();

            $jobQuestion->load('jobQuestionOptions');

            return $this->created(new JobQuestionResource($jobQuestion));
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->server_error($th);
        } 
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobQuestion $jobQuestion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {        

            DB::beginTransaction();

            $jobQuestion  = JobQuestion::find($id);
            if (!$jobQuestion) {
                return $this->not_found();
            }   
            JobQuestionOption::where('job_question_id', $jobQuestion->id)->delete();
                      
            $jobQuestion->delete();
            DB::commit();

            return $this->success();
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->server_error($th);
        } 
    }
}
