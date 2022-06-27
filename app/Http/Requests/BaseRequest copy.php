<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        $response = response()->json([
            'code' => '062',
            'status' => 'invalid_data',
            'successful' => false,
            'message' => 'Invalid data sent',
            'data' => $errors->messages(),
        ], 422);

        throw new HttpResponseException($response);
    }


}
