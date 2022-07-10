<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicantInterviewUpdateRequest extends FormRequest
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
            'applicant_id' => ['required', 'exists:applicants,id'],
            'score' => ['required', 'max:255'],
            'feedback' => ['required', 'max:255', 'string'],
            'start_time' => ['required', 'date'],
            'end_time' => ['required', 'date'],
            'feebacks.*.inteview_question_id' => ['required', 'exists:inteview_questions,id'],
            'feebacks.*.rating' => ['required', 'min:1', 'max:5'],
        ];
    }
}
