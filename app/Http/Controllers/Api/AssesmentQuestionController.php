<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AssesmentQuestion;
use App\Http\Controllers\Controller;
use App\Http\Resources\AssesmentQuestionResource;
use App\Http\Resources\AssesmentQuestionCollection;
use App\Http\Requests\AssesmentQuestionStoreRequest;
use App\Http\Requests\AssesmentQuestionUpdateRequest;

class AssesmentQuestionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', AssesmentQuestion::class);

        $search = $request->get('search', '');

        $assesmentQuestions = AssesmentQuestion::search($search)
            ->latest()
            ->paginate();

        return new AssesmentQuestionCollection($assesmentQuestions);
    }

    /**
     * @param \App\Http\Requests\AssesmentQuestionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssesmentQuestionStoreRequest $request)
    {
        $this->authorize('create', AssesmentQuestion::class);

        $validated = $request->validated();

        $assesmentQuestion = AssesmentQuestion::create($validated);

        return new AssesmentQuestionResource($assesmentQuestion);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AssesmentQuestion $assesmentQuestion
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, AssesmentQuestion $assesmentQuestion)
    {
        $this->authorize('view', $assesmentQuestion);

        return new AssesmentQuestionResource($assesmentQuestion);
    }

    /**
     * @param \App\Http\Requests\AssesmentQuestionUpdateRequest $request
     * @param \App\Models\AssesmentQuestion $assesmentQuestion
     * @return \Illuminate\Http\Response
     */
    public function update(
        AssesmentQuestionUpdateRequest $request,
        AssesmentQuestion $assesmentQuestion
    ) {
        $this->authorize('update', $assesmentQuestion);

        $validated = $request->validated();

        $assesmentQuestion->update($validated);

        return new AssesmentQuestionResource($assesmentQuestion);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AssesmentQuestion $assesmentQuestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        AssesmentQuestion $assesmentQuestion
    ) {
        $this->authorize('delete', $assesmentQuestion);

        $assesmentQuestion->delete();

        return response()->noContent();
    }
}
