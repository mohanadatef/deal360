<?php

namespace App\Http\Requests\Admin\Acl\User;

use App\Models\Acl\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditRequest extends FormRequest
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
        return  [
            'fullname' => 'required|string|unique:users,fullname,'.$this->id.',id',
            'email' => 'required|email|unique:users,email,'.$this->id.',id',
            'phone' => 'required|numeric|unique:users,phone,'.$this->id.',id',
            'gender' => 'required',
            'dob' => 'required',
            'role' => 'required|exists:roles,id',
            'country' => 'required|exists:countries,id',
            'image' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
        ];
    }
}
