<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ApplicantAssesment;
use App\Http\Controllers\Controller;
use App\Http\Resources\AssesmentResponseResource;
use App\Http\Resources\AssesmentResponseCollection;

class ApplicantAssesmentAssesmentResponsesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ApplicantAssesment $applicantAssesment
     * @return \Illuminate\Http\Response
     */
    public function index(
        Request $request,
        ApplicantAssesment $applicantAssesment
    ) {
        $this->authorize('view', $applicantAssesment);

        $search = $request->get('search', '');

        $assesmentResponses = $applicantAssesment
            ->assesmentResponses()
            ->search($search)
            ->latest()
            ->paginate();

        return new AssesmentResponseCollection($assesmentResponses);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ApplicantAssesment $applicantAssesment
     * @return \Illuminate\Http\Response
     */
    public function store(
        Request $request,
        ApplicantAssesment $applicantAssesment
    ) {
        $this->authorize('create', AssesmentResponse::class);

        $validated = $request->validate([
            'assesment_question_id' => [
                'required',
                'exists:assesment_questions,id',
            ],
            'response' => ['nullable', 'max:255', 'string'],
            'assesment_question_option_id' => [
                'nullable',
                'exists:assesment_question_options,id',
            ],
        ]);

        $assesmentResponse = $applicantAssesment
            ->assesmentResponses()
            ->create($validated);

        return new AssesmentResponseResource($assesmentResponse);
    }
}
