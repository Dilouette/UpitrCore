<?php

namespace App\Http\Controllers\Api;

use App\Models\Interview;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\InterviewSectionResource;
use App\Http\Resources\InterviewSectionCollection;

class InterviewInterviewSectionsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Interview $interview
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Interview $interview)
    {
        $this->authorize('view', $interview);

        $search = $request->get('search', '');

        $interviewSections = $interview
            ->interviewSections()
            ->search($search)
            ->latest()
            ->paginate();

        return new InterviewSectionCollection($interviewSections);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Interview $interview
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Interview $interview)
    {
        $this->authorize('create', InterviewSection::class);

        $validated = $request->validate([
            'title' => ['required', 'max:255', 'string'],
            'description' => ['required', 'max:255', 'string'],
        ]);

        $interviewSection = $interview->interviewSections()->create($validated);

        return new InterviewSectionResource($interviewSection);
    }
}
