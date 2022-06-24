<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicantInterviewFeedbackUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'applicant_interview_id' => [
                'required',
                'exists:applicant_interviews,id',
            ],
            'inteview_question_id' => [
                'required',
                'exists:inteview_questions,id',
            ],
            'rating' => ['required', 'max:255'],
        ];
    }
}
