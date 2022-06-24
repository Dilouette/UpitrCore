<?php

namespace App\Http\Controllers\Api;

use App\Models\Assesment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AssesmentQuestionResource;
use App\Http\Resources\AssesmentQuestionCollection;

class AssesmentAssesmentQuestionsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Assesment $assesment
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Assesment $assesment)
    {
        $this->authorize('view', $assesment);

        $search = $request->get('search', '');

        $assesmentQuestions = $assesment
            ->assesmentQuestions()
            ->search($search)
            ->latest()
            ->paginate();

        return new AssesmentQuestionCollection($assesmentQuestions);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Assesment $assesment
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Assesment $assesment)
    {
        $this->authorize('create', AssesmentQuestion::class);

        $validated = $request->validate([
            'question' => ['required', 'max:255', 'string'],
            'question_type_id' => ['required', 'exists:question_types,id'],
            'answer' => ['required', 'max:255', 'string'],
        ]);

        $assesmentQuestion = $assesment
            ->assesmentQuestions()
            ->create($validated);

        return new AssesmentQuestionResource($assesmentQuestion);
    }
}
