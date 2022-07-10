<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ApplicantInterview;
use Illuminate\Support\Facades\Auth;
use App\Models\ApplicantInterviewFeedback;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Resources\ApplicantInterviewResource;
use App\Http\Requests\ApplicantInterviewStoreRequest;
use App\Http\Resources\ApplicantInterviewFeedbackResource;
use App\Http\Resources\ApplicantInterviewFeedbackCollection;
use App\Http\Requests\ApplicantInterviewFeedbackStoreRequest;
use App\Http\Requests\ApplicantInterviewFeedbackUpdateRequest;

class ApplicantInterviewFeedbackController extends ServiceController
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $applicant_id)
    {
        try {

            $page_size = env('DEFAULT_PAGE_SIZE');

            if ($request->filled('page_size')) {
                $page_size = $request->page_size;
            }

            $query = ApplicantInterview::query()
                ->where('applicant_id', $applicant_id)
                ->orderby('created_at', 'desc');

            $interviews = $page_size == '*' ? $query->get() : $query->paginate($page_size);

            return $this->success($interviews);
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }      
    }

    /**
     * @param \App\Http\Requests\ApplicantInterviewStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApplicantInterviewStoreRequest $request)
    {
        try {
            $check = ApplicantInterview::where('applicant_id', $request->applicant_id)
                ->where('interview_id', $request->interview_id)
                ->where('created_by', Auth::user()->id)
                ->first();

            if($check) {
                return $this->bad_request('Interview feedback for this user already exists');
            }

            $validated = $request->validated();
            $validated['created_by'] = Auth::user()->id;
            DB::beginTransaction();
            $interview = ApplicantInterview::create($validated);

            foreach ($validated['feedbacks'] as $feedback) {
                InterviewQuestion::create([
                    'applicant_interview_id' => $interview->id,
                    'interview_section_id' => $feedback['interview_section_id'],
                    'rating' => $feedback['rating'],
                ]);
            }
            DB::commit();
            $interview->load('applicantInterviewFeedbacks');
            return $this->success($interview);
        } catch (\Throwable $th) {
            return $this->server_error($th);
        } 
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ApplicantInterviewFeedback $applicantInterviewFeedback
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $interview  = ApplicantInterview::find($id);
            if (!$interview) {
                return $this->not_found();
            }

            $interview->load('applicantInterviewFeedbacks');

            return $this->success(new ApplicantInterviewResource($interview));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ApplicantInterviewFeedback $applicantInterviewFeedback
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            $interview  = ApplicantInterview::find($id);
            if (!$interview) {
                return $this->not_found();
            }

            $feedbacks = ApplicantInterviewFeedback::where('applicant_interview_id', $id)->get();

            $feedbacks->each(function($feedback) {
                $feedback->delete();
            });

            $interview->delete();
            return $this->success();

        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }
}
