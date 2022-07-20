<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CandidateExperienceUpdateRequest extends BaseRequest
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
            'company' => ['required', 'max:255', 'string'],
            'industry_id' => ['nullable', 'exists:industries,id'],
            'summary' => ['nullable', 'max:255', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date'],
            'candidate_id' => ['nullable', 'exists:candidates,id'],
        ];
    }
}
