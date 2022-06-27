<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobSettingStoreRequest extends BaseRequest
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
            'firstname' => ['required', 'in:Mandatory'],
            'lastname' => ['required', 'in:Mandatory'],
            'email' => ['required', 'in:Mandatory'],
            'dob' => ['required', 'in:Mandatory'],
            'gender' => ['required', 'in:Mandatory'],
            'phone' => ['required', 'in:Mandatory,Optional,Off'],
            'heading' => ['required', 'in:Mandatory,Optional,Off'],
            'address' => ['required', 'in:Mandatory,Optional,Off'],
            'photo' => ['required', 'in:Mandatory,Optional,Off'],
            'education' => ['required', 'in:Mandatory,Optional,Off'],
            'experience' => ['required', 'in:Mandatory,Optional,Off'],
            'summary' => ['required', 'in:Mandatory,Optional,Off'],
            'resume' => ['required', 'in:Mandatory,Optional,Off'],
            'cover_letter' => ['required', 'in:Mandatory,Optional,Off'],
            'cv' => ['required', 'in:Mandatory,Optional,Off'],
        ];
    }
}
