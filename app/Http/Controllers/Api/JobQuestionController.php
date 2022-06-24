<?php

namespace App\Http\Controllers\Api;

use App\Models\JobQuestion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\JobQuestionResource;
use App\Http\Resources\JobQuestionCollection;
use App\Http\Requests\JobQuestionStoreRequest;
use App\Http\Requests\JobQuestionUpdateRequest;

class JobQuestionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', JobQuestion::class);

        $search = $request->get('search', '');

        $jobQuestions = JobQuestion::search($search)
            ->latest()
            ->paginate();

        return new JobQuestionCollection($jobQuestions);
    }

    /**
     * @param \App\Http\Requests\JobQuestionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobQuestionStoreRequest $request)
    {
        $this->authorize('create', JobQuestion::class);

        $validated = $request->validated();

        $jobQuestion = JobQuestion::create($validated);

        return new JobQuestionResource($jobQuestion);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobQuestion $jobQuestion
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, JobQuestion $jobQuestion)
    {
        $this->authorize('view', $jobQuestion);

        return new JobQuestionResource($jobQuestion);
    }

    /**
     * @param \App\Http\Requests\JobQuestionUpdateRequest $request
     * @param \App\Models\JobQuestion $jobQuestion
     * @return \Illuminate\Http\Response
     */
    public function update(
        JobQuestionUpdateRequest $request,
        JobQuestion $jobQuestion
    ) {
        $this->authorize('update', $jobQuestion);

        $validated = $request->validated();

        $jobQuestion->update($validated);

        return new JobQuestionResource($jobQuestion);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobQuestion $jobQuestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, JobQuestion $jobQuestion)
    {
        $this->authorize('delete', $jobQuestion);

        $jobQuestion->delete();

        return response()->noContent();
    }
}
