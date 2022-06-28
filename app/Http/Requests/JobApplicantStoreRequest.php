<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobApplicantStoreRequest extends BaseRequest
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
            'job_id' => ['required', 'numeric', 'exists:jobs,id'],
            'firstname' => ['required', 'max:255', 'string'],
            'lastname' => ['required', 'max:255', 'string'],
            'email' => ['required', 'email'],
            'dob' => ['required', 'date'],
            'gender_id' => ['required', 'min:0', 'max:1'],
            'phone' => ['nullable', 'max:255', 'string'],
            'headline' => ['nullable', 'max:255', 'string'],
            'address' => ['nullable', 'max:255', 'string'],
            'photo' => ['nullable', 'file'],
            'summary' => ['nullable', 'max:255', 'string'],
            'resume' => ['nullable', 'file'],
            'cover_letter' => ['nullable', 'file'],
            'skills' => ['nullable', 'string'],
        ];
    }
}
