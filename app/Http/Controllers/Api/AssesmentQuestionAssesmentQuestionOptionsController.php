<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AssesmentQuestion;
use App\Http\Controllers\Controller;
use App\Http\Resources\AssesmentQuestionOptionResource;
use App\Http\Resources\AssesmentQuestionOptionCollection;

class AssesmentQuestionAssesmentQuestionOptionsController extends Controller
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

        $assesmentQuestionOptions = $assesmentQuestion
            ->assesmentQuestionOptions()
            ->search($search)
            ->latest()
            ->paginate();

        return new AssesmentQuestionOptionCollection($assesmentQuestionOptions);
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
        $this->authorize('create', AssesmentQuestionOption::class);

        $validated = $request->validate([
            'is_answer' => ['required', 'boolean'],
        ]);

        $assesmentQuestionOption = $assesmentQuestion
            ->assesmentQuestionOptions()
            ->create($validated);

        return new AssesmentQuestionOptionResource($assesmentQuestionOption);
    }
}
