<?php

namespace App\Http\Requests\Api\Acl\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CreateRequest extends FormRequest
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
        $rules = [
            'fullname' => 'required|string|unique:users',
            'username' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
        ];
        if (!isset($request->type)) {
            $rules = [
                'password' => 'required|string|min:6|confirmed',
            ];
        }
        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response(['status' => 0, 'data' => [], 'message' => $validator->errors()]));
    }
}
