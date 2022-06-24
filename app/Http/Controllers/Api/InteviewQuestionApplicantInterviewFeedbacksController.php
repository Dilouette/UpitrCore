<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\InteviewQuestion;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApplicantInterviewFeedbackResource;
use App\Http\Resources\ApplicantInterviewFeedbackCollection;

class InteviewQuestionApplicantInterviewFeedbacksController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\InteviewQuestion $inteviewQuestion
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, InteviewQuestion $inteviewQuestion)
    {
        $this->authorize('view', $inteviewQuestion);

        $search = $request->get('search', '');

        $applicantInterviewFeedbacks = $inteviewQuestion
            ->applicantInterviewFeedbacks()
            ->search($search)
            ->latest()
            ->paginate();

        return new ApplicantInterviewFeedbackCollection(
            $applicantInterviewFeedbacks
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\InteviewQuestion $inteviewQuestion
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, InteviewQuestion $inteviewQuestion)
    {
        $this->authorize('create', ApplicantInterviewFeedback::class);

        $validated = $request->validate([
            'applicant_interview_id' => [
                'required',
                'exists:applicant_interviews,id',
            ],
            'rating' => ['required', 'max:255'],
        ]);

        $applicantInterviewFeedback = $inteviewQuestion
            ->applicantInterviewFeedbacks()
            ->create($validated);

        return new ApplicantInterviewFeedbackResource(
            $applicantInterviewFeedback
        );
    }
}
