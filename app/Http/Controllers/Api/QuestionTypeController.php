<?php

namespace App\Http\Controllers\Api;

use App\Models\QuestionType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionTypeResource;
use App\Http\Resources\QuestionTypeCollection;
use App\Http\Requests\QuestionTypeStoreRequest;
use App\Http\Requests\QuestionTypeUpdateRequest;

class QuestionTypeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', QuestionType::class);

        $search = $request->get('search', '');

        $questionTypes = QuestionType::search($search)
            ->latest()
            ->paginate();

        return new QuestionTypeCollection($questionTypes);
    }

    /**
     * @param \App\Http\Requests\QuestionTypeStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionTypeStoreRequest $request)
    {
        $this->authorize('create', QuestionType::class);

        $validated = $request->validated();

        $questionType = QuestionType::create($validated);

        return new QuestionTypeResource($questionType);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\QuestionType $questionType
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, QuestionType $questionType)
    {
        $this->authorize('view', $questionType);

        return new QuestionTypeResource($questionType);
    }

    /**
     * @param \App\Http\Requests\QuestionTypeUpdateRequest $request
     * @param \App\Models\QuestionType $questionType
     * @return \Illuminate\Http\Response
     */
    public function update(
        QuestionTypeUpdateRequest $request,
        QuestionType $questionType
    ) {
        $this->authorize('update', $questionType);

        $validated = $request->validated();

        $questionType->update($validated);

        return new QuestionTypeResource($questionType);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\QuestionType $questionType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, QuestionType $questionType)
    {
        $this->authorize('delete', $questionType);

        $questionType->delete();

        return response()->noContent();
    }
}
