<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AssesmentQuestion;
use App\Http\Controllers\Controller;
use App\Http\Resources\AssesmentResponseResource;
use App\Http\Resources\AssesmentResponseCollection;

class AssesmentQuestionAssesmentResponsesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AssesmentQuestion $assesmentQuestion
     * @return \Illuminate\Http\Response
     */
    public function index(
        Request $request,
        AssesmentQuestion $assesmentQuestion
    ) {
        $this->authorize('view', $assesmentQuestion);

        $search = $request->get('search', '');

        $assesmentResponses = $assesmentQuestion
            ->assesmentResponses()
            ->search($search)
            ->latest()
            ->paginate();

        return new AssesmentResponseCollection($assesmentResponses);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AssesmentQuestion $assesmentQuestion
     * @return \Illuminate\Http\Response
     */
    public function store(
        Request $request,
        AssesmentQuestion $assesmentQuestion
    ) {
        $this->authorize('create', AssesmentResponse::class);

        $validated = $request->validate([
            'applicant_assesment_id' => [
                'required',
                'exists:applicant_assesments,id',
            ],
            'response' => ['nullable', 'max:255', 'string'],
            'assesment_question_option_id' => [
                'nullable',
                'exists:assesment_question_options,id',
            ],
        ]);

        $assesmentResponse = $assesmentQuestion
            ->assesmentResponses()
            ->create($validated);

        return new AssesmentResponseResource($assesmentResponse);
    }
}
