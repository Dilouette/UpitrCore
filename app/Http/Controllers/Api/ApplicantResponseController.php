<?php

namespace App\Http\Controllers\Api;

use App\Models\JobApplicant;
use Illuminate\Http\Request;
use App\Models\ApplicantResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApplicantResponseResource;
use App\Http\Resources\ApplicantResponseCollection;
use App\Http\Requests\ApplicantResponseStoreRequest;
use App\Http\Requests\ApplicantResponseUpdateRequest;

class ApplicantResponseController extends ServiceController
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index($applicant_id)
    {
        try {
            $applicantResponses = ApplicantResponse::where('job_applicant_id',$applicant_id)->orderBy('id', 'asc')->get();

            return $this->success(new ApplicantResponseCollection($applicantResponses));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }  
        
    }

    /**
     * @param \App\Http\Requests\ApplicantResponseStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApplicantResponseStoreRequest $request)
    {
        try {        

            $validated = $request->validated();

            foreach($validated['questions'] as $question){ 

                // Get the applicant
                $applicant = JobApplicant::find($validated['job_applicant_id']);

                //Check if the question is valid for the selected job
                $jobQuestion = $applicant->job->jobQuestions()->where('id', $question['job_question_id'])->first();

                if (!$jobQuestion) {
                    $msg = 'Question ' . $question['job_question_id'] . ' is not valid for job ' . $applicant->job->id;
                    return $this->not_found(null, $msg);
                }

                //Check if job question option is valid for the selected question
                if (isset($question['job_question_option_id'])) {
                    $jobQuestionOption = $jobQuestion->job_question_options()->where('id', $question['job_question_option_id'])->first();
                    if (!$jobQuestionOption) {
                        $msg = 'Question option ' . $question['job_question_option_id'] . ' is not valid for question ' . $question['job_question_id'];
                        return $this->not_found(null, $msg);
                    }
                }

                //Check if question already exists for the applicant
                $questionExists = ApplicantResponse::where('job_applicant_id',$validated['job_applicant_id'])->where('job_question_id',$question['job_question_id'])->first();
                if ($questionExists) {
                    $questionExists->job_question_option_id = $question['job_question_option_id'];
                    $questionExists->response = $question['response'];
                    $questionExists->save();
                } else {
                    $applicantResponse = new ApplicantResponse();

                    $applicantResponse->job_applicant_id = $validated['job_applicant_id'];
                    $applicantResponse->job_question_id = $question['job_question_id'];
                    $applicantResponse->job_question_option_id = $question['job_question_option_id'];
                    $applicantResponse->response = $question['response'];

                    $applicantResponse->save();
                }
            }

            $applicantResponses = ApplicantResponse::where('job_applicant_id',$validated['job_applicant_id'])->orderBy('id', 'asc')->get();

            return $this->success(new ApplicantResponseCollection($applicantResponses));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }       
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ApplicantResponse $applicantResponse
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ApplicantResponse $applicantResponse)
    {
        $this->authorize('view', $applicantResponse);

        return new ApplicantResponseResource($applicantResponse);
    }

    /**
     * @param \App\Http\Requests\ApplicantResponseUpdateRequest $request
     * @param \App\Models\ApplicantResponse $applicantResponse
     * @return \Illuminate\Http\Response
     */
    public function update(
        ApplicantResponseUpdateRequest $request,
        ApplicantResponse $applicantResponse
    ) {
        $this->authorize('update', $applicantResponse);

        $validated = $request->validated();

        $applicantResponse->update($validated);

        return new ApplicantResponseResource($applicantResponse);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ApplicantResponse $applicantResponse
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        ApplicantResponse $applicantResponse
    ) {
        $this->authorize('delete', $applicantResponse);

        $applicantResponse->delete();

        return response()->noContent();
    }
}
