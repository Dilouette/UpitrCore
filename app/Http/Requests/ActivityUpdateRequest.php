<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActivityUpdateRequest extends FormRequest
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
            'activity_type_id' => ['required', 'max:255'],
            'title' => ['required', 'max:255', 'string'],
            'start' => ['required', 'date'],
            'end' => ['required', 'date'],
            'location' => ['required', 'max:255', 'string'],
            'meeting_url' => ['required', 'max:255', 'string'],
            'related_to_id' => ['required', 'max:255'],
            'importance_id' => ['required', 'max:255'],
            'description' => ['required', 'max:255', 'string'],
            'created_by' => ['required', 'max:255'],
            'updated_by' => ['required', 'max:255'],
            'job_applicant_id' => ['nullable', 'exists:job_applicants,id'],
            'job_id' => ['nullable', 'exists:jobs,id'],
        ];
    }
}
