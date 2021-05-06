<?php

namespace App\Http\Requests\Admin\Acl\Role;

use Illuminate\Foundation\Http\FormRequest;

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
            return [
                'title.*'=>'required|unique_translation:roles,title,'.$this->id,
                'permission' => 'required|exists:permissions,id',
            ];

    }
    public function messages()
    {
        if (languageLocale() == 'ar') {
            return [
                'permission.required' => 'برجاء اختيار الاذونات',
                'title.*.required' => 'برجاء ادخال الاسم',
                'title.*.unique_translation' => 'لا يمكن ادخال الاسم متكرر',
            ];
        }
        else{
            return [];
        }
    }
}
