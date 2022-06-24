<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AssesmentQuestionOption;
use App\Http\Resources\AssesmentResponseResource;
use App\Http\Resources\AssesmentResponseCollection;

class AssesmentQuestionOptionAssesmentResponsesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AssesmentQuestionOption $assesmentQuestionOption
     * @return \Illuminate\Http\Response
     */
    public function index(
        Request $request,
        AssesmentQuestionOption $assesmentQuestionOption
    ) {
        $this->authorize('view', $assesmentQuestionOption);

        $search = $request->get('search', '');

        $assesmentResponses = $assesmentQuestionOption
            ->assesmentResponses()
            ->search($search)
            ->latest()
            ->paginate();

        return new AssesmentResponseCollection($assesmentResponses);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AssesmentQuestionOption $assesmentQuestionOption
     * @return \Illuminate\Http\Response
     */
    public function store(
        Request $request,
        AssesmentQuestionOption $assesmentQuestionOption
    ) {
        $this->authorize('create', AssesmentResponse::class);

        $validated = $request->validate([
            'applicant_assesment_id' => [
                'required',
                'exists:applicant_assesments,id',
            ],
            'assesment_question_id' => [
                'required',
                'exists:assesment_questions,id',
            ],
            'response' => ['nullable', 'max:255', 'string'],
        ]);

        $assesmentResponse = $assesmentQuestionOption
            ->assesmentResponses()
            ->create($validated);

        return new AssesmentResponseResource($assesmentResponse);
    }
}
