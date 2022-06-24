<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicantInterviewStoreRequest extends FormRequest
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
            'score' => ['required', 'max:255'],
            'feedback' => ['required', 'max:255', 'string'],
            'start_time' => ['required', 'date'],
            'end_time' => ['required', 'date'],
        ];
    }
}
