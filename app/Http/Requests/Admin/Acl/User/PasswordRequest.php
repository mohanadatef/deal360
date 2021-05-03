<?php

namespace App\Http\Requests\Admin\Acl\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class PasswordRequest extends FormRequest
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
            'password' => 'required|string|min:6|confirmed',
        ];
    }
    public function messages()
    {
        return ( $this->language_id ? check_locale_language($this->language_id) : Language_Locale() ) == 'ar' ? [
                'password.required' => 'برجاء ادخال كلمه السر',
                'password.string' => 'برجاء ادخال كلمه السر حروف',
                'password.confirmed' => 'برجاء ادخال تاكيد كلمه السر',
                'password.min' => 'برجاء ادخال كلمه السر اكثر من 6',
            ] : [];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(
            response(['status' => 0, 'data' => ['errors'=>$errors]], 400)
        );
    }
}
