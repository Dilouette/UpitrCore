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
            'firstname' => ['required', 'max:128', 'string'],
            'lastname' => ['required', 'max:128', 'string'],
            'email' => ['required', 'email'],
            'dob' => ['required', 'date'],
            'gender_id' => ['required', 'min:0', 'max:1'],
            'phone' => ['nullable', 'max:64', 'string'],
            'headline' => ['nullable', 'max:256', 'string'],
            'address' => ['nullable', 'max:256', 'string'],
            'photo' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,svg'],
            'summary' => ['nullable', 'max:512', 'string'],
            'resume' => ['nullable', 'file', 'mimes:pdf,doc,docx,ppt,pptx', 'max:10240'],
            'cover_letter' => ['nullable', 'file', 'mimes:pdf,doc,docx,ppt,pptx', 'max:10240'],
            'skills' => ['nullable', 'string'],
        ];
    }
}
