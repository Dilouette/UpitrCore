<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteStoreRequest extends FormRequest
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
            'content' => ['required', 'max:255', 'string'],
            'related_to_id' => ['required', 'max:255'],
            'created_by' => ['required', 'max:255'],
            'job_id' => ['required', 'exists:jobs,id'],
            'updated_by' => ['required', 'max:255'],
            'applicant_id' => ['required', 'exists:applicants,id'],
        ];
    }
}
