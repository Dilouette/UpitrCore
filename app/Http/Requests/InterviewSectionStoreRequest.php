<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InterviewSectionStoreRequest extends BaseRequest
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
            'title' => ['required', 'max:255', 'string'],
            'interview_id' => ['required', 'exists:interviews,id'],
            'questions.*.title' => ['nullable', 'max:256', 'string'],
            'questions.*.question' => ['required', 'max:512', 'string'],
        ];
    }
}
