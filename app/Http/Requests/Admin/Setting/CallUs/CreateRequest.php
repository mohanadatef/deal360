<?php

namespace App\Http\Requests\Admin\Setting\CallUs;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

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

        return [
            'detail'=>'required|string|max:255',
            'title' => 'required|string|max:255',
            'mobile' => 'required|numeric|digits:11',
            'email' => 'required|email|max:255|string',
        ];
    }
    public function messages()
    {
        return check_locale_language($this->language_id) == 'ar' ? [
            'detail.required' => 'برجاء ادخال الوصف',
            'detail.string' => 'برجاء ادخال الوصف حروف',
            'detail.max' => 'برجاء ادخال الوصف حروف اقل من 255',
            'title.required' => 'برجاء ادخال الاسم',
            'title.string' => 'برجاء ادخال الاسم حروف',
            'title.max' => 'برجاء ادخال الاسم حروف اقل من 255',
            'mobile.required' => 'برجاء ادخال الموبيل',
            'mobile.numeric' => 'برجاء ادخال الموبيل ارقام',
            'mobile.digits' => 'برجاء ادخال الموبيل 11',
            'email.required' => 'برجاء ادخال البريد الالكتروني',
            'email.email' => 'برجاء ادخال البريد الالكتروني',
            'email.string' => 'برجاء ادخال البريد الالكتروني حروف',
            'email.max' => 'برجاء ادخال البريد الالكتروني حروف اقل من 255',
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
