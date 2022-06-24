<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\InterviewSection;
use App\Http\Controllers\Controller;
use App\Http\Resources\InterviewSectionResource;
use App\Http\Resources\InterviewSectionCollection;
use App\Http\Requests\InterviewSectionStoreRequest;
use App\Http\Requests\InterviewSectionUpdateRequest;

class InterviewSectionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', InterviewSection::class);

        $search = $request->get('search', '');

        $interviewSections = InterviewSection::search($search)
            ->latest()
            ->paginate();

        return new InterviewSectionCollection($interviewSections);
    }

    /**
     * @param \App\Http\Requests\InterviewSectionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(InterviewSectionStoreRequest $request)
    {
        $this->authorize('create', InterviewSection::class);

        $validated = $request->validated();

        $interviewSection = InterviewSection::create($validated);

        return new InterviewSectionResource($interviewSection);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\InterviewSection $interviewSection
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, InterviewSection $interviewSection)
    {
        $this->authorize('view', $interviewSection);

        return new InterviewSectionResource($interviewSection);
    }

    /**
     * @param \App\Http\Requests\InterviewSectionUpdateRequest $request
     * @param \App\Models\InterviewSection $interviewSection
     * @return \Illuminate\Http\Response
     */
    public function update(
        InterviewSectionUpdateRequest $request,
        InterviewSection $interviewSection
    ) {
        $this->authorize('update', $interviewSection);

        $validated = $request->validated();

        $interviewSection->update($validated);

        return new InterviewSectionResource($interviewSection);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\InterviewSection $interviewSection
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        InterviewSection $interviewSection
    ) {
        $this->authorize('delete', $interviewSection);

        $interviewSection->delete();

        return response()->noContent();
    }
}
