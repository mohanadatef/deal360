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
        $rules = [
            'fullname' => 'required|string|unique:users,fullname,'.$this->id.',id',
            'username' => 'required|string|unique:users,username,'.$this->id.',id',
            'email' => 'required|email|unique:users,email,'.$this->id.',id',
            'phone' => 'required|numeric|unique:users,phone,'.$this->id.',id',
            'gender' => 'required',
            'dob' => 'required',
            'role_id' => 'required|exists:roles,id',
            'country_id' => 'required|exists:countries,id',
            'password' => 'required|string|min:6|confirmed',
        ];
        foreach(language() as $lang)
        {
            $rules['title.'.$lang->code] = ['required','string',
                Rule::unique('translations','value')
                    ->ignore($this->id, 'category_id')
                    ->where('category_type',User::class)
                    ->where('key','title')
                    ->where('language_id',$lang->id)
            ];
        }
        return $rules;
    }
}
