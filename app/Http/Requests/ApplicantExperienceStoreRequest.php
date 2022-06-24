<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicantExperienceStoreRequest extends FormRequest
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
            'company' => ['nullable', 'max:255', 'string'],
            'industry_id' => ['nullable', 'numeric'],
            'summary' => ['nullable', 'max:255', 'string'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date'],
            'job_applicant_id' => ['required', 'exists:job_applicants,id'],
        ];
    }
}
