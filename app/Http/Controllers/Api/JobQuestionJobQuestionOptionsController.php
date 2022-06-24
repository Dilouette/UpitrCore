<?php

namespace App\Http\Controllers\Api;

use App\Models\JobQuestion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\JobQuestionOptionResource;
use App\Http\Resources\JobQuestionOptionCollection;

class JobQuestionJobQuestionOptionsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobQuestion $jobQuestion
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, JobQuestion $jobQuestion)
    {
        $this->authorize('view', $jobQuestion);

        $search = $request->get('search', '');

        $jobQuestionOptions = $jobQuestion
            ->jobQuestionOptions()
            ->search($search)
            ->latest()
            ->paginate();

        return new JobQuestionOptionCollection($jobQuestionOptions);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobQuestion $jobQuestion
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, JobQuestion $jobQuestion)
    {
        $this->authorize('create', JobQuestionOption::class);

        $validated = $request->validate([
            'option' => ['required', 'max:255', 'string'],
        ]);

        $jobQuestionOption = $jobQuestion
            ->jobQuestionOptions()
            ->create($validated);

        return new JobQuestionOptionResource($jobQuestionOption);
    }
}
