<?php

namespace App\Http\Requests\Admin\Acl\User;

use App\Models\Acl\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'fullname' => 'required|string|unique:users',
            'username' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric|unique:users',
            'gender' => 'required',
            'facebook' => 'url',
            'instagram' => 'url',
            'youtube' => 'url',
            'twitter' => 'url',
            'website' => 'url',
            'dob' => 'required',
            'role' => 'required|exists:roles,id',
            'country' => 'required|exists:countries,id',
            'password' => 'required|string|min:6|confirmed',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ];
    }
}
