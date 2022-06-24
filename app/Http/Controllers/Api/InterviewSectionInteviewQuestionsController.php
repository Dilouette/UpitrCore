<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\InterviewSection;
use App\Http\Controllers\Controller;
use App\Http\Resources\InteviewQuestionResource;
use App\Http\Resources\InteviewQuestionCollection;

class InterviewSectionInteviewQuestionsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\InterviewSection $interviewSection
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, InterviewSection $interviewSection)
    {
        $this->authorize('view', $interviewSection);

        $search = $request->get('search', '');

        $inteviewQuestions = $interviewSection
            ->inteviewQuestions()
            ->search($search)
            ->latest()
            ->paginate();

        return new InteviewQuestionCollection($inteviewQuestions);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\InterviewSection $interviewSection
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, InterviewSection $interviewSection)
    {
        $this->authorize('create', InteviewQuestion::class);

        $validated = $request->validate([
            'question' => ['required', 'max:255', 'string'],
            'title' => ['required', 'max:255', 'string'],
        ]);

        $inteviewQuestion = $interviewSection
            ->inteviewQuestions()
            ->create($validated);

        return new InteviewQuestionResource($inteviewQuestion);
    }
}
