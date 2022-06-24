<?php

namespace App\Http\Controllers\Api;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\JobQuestionResource;
use App\Http\Resources\JobQuestionCollection;

class JobJobQuestionsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Job $job
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Job $job)
    {
        $this->authorize('view', $job);

        $search = $request->get('search', '');

        $jobQuestions = $job
            ->jobQuestions()
            ->search($search)
            ->latest()
            ->paginate();

        return new JobQuestionCollection($jobQuestions);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Job $job
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Job $job)
    {
        $this->authorize('create', JobQuestion::class);

        $validated = $request->validate([
            'question' => ['required', 'max:255', 'string'],
            'job_question_type_id' => ['required', 'exists:question_types,id'],
        ]);

        $jobQuestion = $job->jobQuestions()->create($validated);

        return new JobQuestionResource($jobQuestion);
    }
}
