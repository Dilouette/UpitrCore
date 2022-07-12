<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicantBulkMoveRequest extends BaseRequest
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
            'job_workflow_stage_id' => ['required', 'numeric', 'exists:job_workflow_stages,id'],
            'applicants' => ['required', 'array'],
            'applicants.*' => ['distinct', 'integer', 'exists:applicants,id'],
        ];
    }
}
