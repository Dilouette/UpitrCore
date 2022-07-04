<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InterviewQuestionStoreRequest extends BaseRequest
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
            'interview_section_id' => [
                'required',
                'exists:interview_sections,id',
            ],
            'question' => ['required', 'max:512', 'string'],
            'title' => ['nullable', 'max:256', 'string'],
        ];
    }
}
