<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssesmentResponseUpdateRequest extends FormRequest
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
            'applicant_assesment_id' => [
                'required',
                'exists:applicant_assesments,id',
            ],
            'assesment_question_id' => [
                'required',
                'exists:assesment_questions,id',
            ],
            'response' => ['nullable', 'max:255', 'string'],
            'assesment_question_option_id' => [
                'nullable',
                'exists:assesment_question_options,id',
            ],
        ];
    }
}
