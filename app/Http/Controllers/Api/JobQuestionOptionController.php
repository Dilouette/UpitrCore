<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\JobQuestionOption;
use App\Http\Controllers\Controller;
use App\Http\Resources\JobQuestionOptionResource;
use App\Http\Resources\JobQuestionOptionCollection;
use App\Http\Requests\JobQuestionOptionStoreRequest;
use App\Http\Requests\JobQuestionOptionUpdateRequest;

class JobQuestionOptionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', JobQuestionOption::class);

        $search = $request->get('search', '');

        $jobQuestionOptions = JobQuestionOption::search($search)
            ->latest()
            ->paginate();

        return new JobQuestionOptionCollection($jobQuestionOptions);
    }

    /**
     * @param \App\Http\Requests\JobQuestionOptionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobQuestionOptionStoreRequest $request)
    {
        $this->authorize('create', JobQuestionOption::class);

        $validated = $request->validated();

        $jobQuestionOption = JobQuestionOption::create($validated);

        return new JobQuestionOptionResource($jobQuestionOption);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobQuestionOption $jobQuestionOption
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, JobQuestionOption $jobQuestionOption)
    {
        $this->authorize('view', $jobQuestionOption);

        return new JobQuestionOptionResource($jobQuestionOption);
    }

    /**
     * @param \App\Http\Requests\JobQuestionOptionUpdateRequest $request
     * @param \App\Models\JobQuestionOption $jobQuestionOption
     * @return \Illuminate\Http\Response
     */
    public function update(
        JobQuestionOptionUpdateRequest $request,
        JobQuestionOption $jobQuestionOption
    ) {
        $this->authorize('update', $jobQuestionOption);

        $validated = $request->validated();

        $jobQuestionOption->update($validated);

        return new JobQuestionOptionResource($jobQuestionOption);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobQuestionOption $jobQuestionOption
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        JobQuestionOption $jobQuestionOption
    ) {
        $this->authorize('delete', $jobQuestionOption);

        $jobQuestionOption->delete();

        return response()->noContent();
    }
}
