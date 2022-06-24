<?php

namespace App\Http\Controllers\Api;

use App\Models\QuestionType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\JobQuestionResource;
use App\Http\Resources\JobQuestionCollection;

class QuestionTypeJobQuestionsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\QuestionType $questionType
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, QuestionType $questionType)
    {
        $this->authorize('view', $questionType);

        $search = $request->get('search', '');

        $jobQuestions = $questionType
            ->jobQuestions()
            ->search($search)
            ->latest()
            ->paginate();

        return new JobQuestionCollection($jobQuestions);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\QuestionType $questionType
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, QuestionType $questionType)
    {
        $this->authorize('create', JobQuestion::class);

        $validated = $request->validate([
            'job_id' => ['required', 'exists:jobs,id'],
            'question' => ['required', 'max:255', 'string'],
        ]);

        $jobQuestion = $questionType->jobQuestions()->create($validated);

        return new JobQuestionResource($jobQuestion);
    }
}
