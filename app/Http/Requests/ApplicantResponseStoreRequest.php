<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicantResponseStoreRequest extends BaseRequest
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
            'questions' => ['required', 'array'],
            'questions.*.job_question_id' => ['required', 'exists:job_questions,id'],
            'questions.*.job_question_option_id' => [
                'nullable',
                'exists:job_question_options,id',
            ],
            'questions.*.response' => ['nullable', 'string'],
        ];
    }
}
