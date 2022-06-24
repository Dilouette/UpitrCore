<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AssesmentQuestionOption;
use App\Http\Resources\AssesmentQuestionOptionResource;
use App\Http\Resources\AssesmentQuestionOptionCollection;
use App\Http\Requests\AssesmentQuestionOptionStoreRequest;
use App\Http\Requests\AssesmentQuestionOptionUpdateRequest;

class AssesmentQuestionOptionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', AssesmentQuestionOption::class);

        $search = $request->get('search', '');

        $assesmentQuestionOptions = AssesmentQuestionOption::search($search)
            ->latest()
            ->paginate();

        return new AssesmentQuestionOptionCollection($assesmentQuestionOptions);
    }

    /**
     * @param \App\Http\Requests\AssesmentQuestionOptionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssesmentQuestionOptionStoreRequest $request)
    {
        $this->authorize('create', AssesmentQuestionOption::class);

        $validated = $request->validated();

        $assesmentQuestionOption = AssesmentQuestionOption::create($validated);

        return new AssesmentQuestionOptionResource($assesmentQuestionOption);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AssesmentQuestionOption $assesmentQuestionOption
     * @return \Illuminate\Http\Response
     */
    public function show(
        Request $request,
        AssesmentQuestionOption $assesmentQuestionOption
    ) {
        $this->authorize('view', $assesmentQuestionOption);

        return new AssesmentQuestionOptionResource($assesmentQuestionOption);
    }

    /**
     * @param \App\Http\Requests\AssesmentQuestionOptionUpdateRequest $request
     * @param \App\Models\AssesmentQuestionOption $assesmentQuestionOption
     * @return \Illuminate\Http\Response
     */
    public function update(
        AssesmentQuestionOptionUpdateRequest $request,
        AssesmentQuestionOption $assesmentQuestionOption
    ) {
        $this->authorize('update', $assesmentQuestionOption);

        $validated = $request->validated();

        $assesmentQuestionOption->update($validated);

        return new AssesmentQuestionOptionResource($assesmentQuestionOption);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AssesmentQuestionOption $assesmentQuestionOption
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        AssesmentQuestionOption $assesmentQuestionOption
    ) {
        $this->authorize('delete', $assesmentQuestionOption);

        $assesmentQuestionOption->delete();

        return response()->noContent();
    }
}
