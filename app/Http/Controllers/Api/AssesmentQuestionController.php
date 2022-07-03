<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AssesmentQuestion;
use App\Http\Controllers\Controller;
use App\Http\Resources\AssesmentQuestionResource;
use App\Http\Resources\AssesmentQuestionCollection;
use App\Http\Requests\AssesmentQuestionStoreRequest;
use App\Http\Requests\AssesmentQuestionUpdateRequest;

class AssesmentQuestionController extends ServiceController
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            $page_size = env('DEFAULT_PAGE_SIZE');

            if ($request->filled('page_size')) {
                $page_size = $request->page_size;
            }

            $query = AssesmentQuestion::query()
                ->orderby('id', 'asc');

            $jobs = $query->paginate($page_size);
            
            return $this->success($jobs);
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }    
    }

    /**
     * @param \App\Http\Requests\AssesmentQuestionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function bulk(AssesmentQuestionStoreRequest $request)
    {
        Log::info($request);

        $validated = $request->validated();

        $assesmentQuestion = AssesmentQuestion::create($validated);

        return new AssesmentQuestionResource($assesmentQuestion);
    }

    /**
     * @param \App\Http\Requests\AssesmentQuestionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssesmentQuestionStoreRequest $request)
    {
        Log::info($request);

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
