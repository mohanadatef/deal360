<?php

namespace App\Http\Requests\Admin\Acl\User;

use Illuminate\Foundation\Http\FormRequest;

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
            'title.*' => 'required',
            'gender' => 'required|string',
            'mobile' => 'required|numeric|digits:11|unique:users',
            'email' => 'required|email|max:255|string|unique:users',
            'date_birth' => 'required|date',
            'image' => 'image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'required|exists:roles,id',
        ];
    }

    public function messages()
    {
        return Language_Locale() == 'ar' ? [
            'image.mimes' => 'برجاء ادخال الصوره jpg,jpeg,png,gif',
            'image.max' => 'برجاء ادخال الصوره اقل من 2048',
            'title.*.required' => 'برجاء ادخال الاسم',
            'gender.required' => 'برجاء ادخال النوع',
            'mobile.required' => 'برجاء ادخال الموبيل',
            'mobile.unique' => 'لا يمكن ادخال الموبيل متكرر',
            'email.required' => 'برجاء ادخال البريد الالكتروني',
            'email.unique' => 'لا يمكن ادخال البريد الالكتروني متكرر',
            'date_birth.required' => 'برجاء ادخال تاريخ الميلاد',
            'date_birth.date' => 'برجاء ادخال تاريخ الميلاد تاريخ',
            'password.required' => 'برجاء ادخال كلمه السر',
            'password.string' => 'برجاء ادخال كلمه السر حروف',
            'password.confirmed' => 'برجاء ادخال تاكيد كلمه السر',
            'password.min' => 'برجاء ادخال كلمه السر اكثر من 6',
            'role_id.required' => 'برجاء ادخال صلحيات',
            'role_id.exists' => 'برجاء ادخال صلحيات',
            'mobile.numeric' => 'برجاء ادخال ارقام',
            'mobile.digits' => 'برجاء ادخال ارقام 11',
        ] : [];
    }
}
