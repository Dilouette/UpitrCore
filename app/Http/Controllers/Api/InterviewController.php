<?php

namespace App\Http\Controllers\Api;

use App\Models\Interview;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\InterviewResource;
use App\Http\Resources\InterviewCollection;
use App\Http\Requests\InterviewStoreRequest;
use App\Http\Requests\InterviewUpdateRequest;

class InterviewController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Interview::class);

        $search = $request->get('search', '');

        $interviews = Interview::search($search)
            ->latest()
            ->paginate();

        return new InterviewCollection($interviews);
    }

    /**
     * @param \App\Http\Requests\InterviewStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(InterviewStoreRequest $request)
    {
        $this->authorize('create', Interview::class);

        $validated = $request->validated();

        $interview = Interview::create($validated);

        return new InterviewResource($interview);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Interview $interview
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Interview $interview)
    {
        $this->authorize('view', $interview);

        return new InterviewResource($interview);
    }

    /**
     * @param \App\Http\Requests\InterviewUpdateRequest $request
     * @param \App\Models\Interview $interview
     * @return \Illuminate\Http\Response
     */
    public function update(
        InterviewUpdateRequest $request,
        Interview $interview
    ) {
        $this->authorize('update', $interview);

        $validated = $request->validated();

        $interview->update($validated);

        return new InterviewResource($interview);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Interview $interview
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Interview $interview)
    {
        $this->authorize('delete', $interview);

        $interview->delete();

        return response()->noContent();
    }
}
