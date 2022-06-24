<?php

namespace App\Http\Controllers\Api;

use App\Models\QuestionType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AssesmentQuestionResource;
use App\Http\Resources\AssesmentQuestionCollection;

class QuestionTypeAssesmentQuestionsController extends Controller
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

        $assesmentQuestions = $questionType
            ->assesmentQuestions()
            ->search($search)
            ->latest()
            ->paginate();

        return new AssesmentQuestionCollection($assesmentQuestions);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\QuestionType $questionType
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, QuestionType $questionType)
    {
        $this->authorize('create', AssesmentQuestion::class);

        $validated = $request->validate([
            'assesment_id' => ['required', 'exists:assesments,id'],
            'question' => ['required', 'max:255', 'string'],
            'answer' => ['required', 'max:255', 'string'],
        ]);

        $assesmentQuestion = $questionType
            ->assesmentQuestions()
            ->create($validated);

        return new AssesmentQuestionResource($assesmentQuestion);
    }
}
