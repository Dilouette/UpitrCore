<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssesmentQuestionStoreBulkRequest extends FormRequest
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
            'assesment_id' => ['required', 'exists:assesments,id'],
            'questions.*.question' => ['required', 'max:255', 'string'],
            'questions.*.question_type_id' => ['required', 'exists:question_types,id'],
            'questions.*.answer' => ['nullable', 'max:255', 'string'],
            'questions.*.options.*.value' => ['required', 'max:255', 'string'],
            'questions.*.options.*.is_answer' => ['required', 'boolean'],
        ];
    }
}
