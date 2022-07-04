<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssesmentUpdateRequest extends BaseRequest
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
            'is_timed' => ['required', 'boolean'],
            'duration' => ['required', 'numeric'],
            'pass_score' => ['required', 'numeric'],
            'questions_per_candidate' => ['required','gte:pass_score', 'numeric'],
        ];
    }
}
