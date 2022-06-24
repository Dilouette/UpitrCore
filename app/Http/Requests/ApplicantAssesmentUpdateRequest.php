<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicantAssesmentUpdateRequest extends FormRequest
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
            'job_applicant_id' => ['required', 'exists:job_applicants,id'],
            'status_id' => ['nullable', 'max:255'],
            'score' => ['nullable', 'numeric'],
            'start_time' => ['required', 'date'],
            'end_time' => ['required', 'date'],
            'ip' => ['required', 'max:255'],
            'user_agent' => ['required', 'max:255', 'string'],
        ];
    }
}
