<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobQuestionUpdateRequest extends BaseRequest
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
            'job_id' => ['required', 'exists:jobs,id'],
            'question' => ['required', 'max:255', 'string'],
            'job_question_type_id' => ['required', 'exists:question_types,id'],
            'question_options.*' => ['distinct', 'max:255', 'string'],
        ];
    }
}
