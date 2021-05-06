<?php

namespace App\Http\Requests\Admin\Acl\Permission;

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
            'title'=>'required|string|unique:permissions',
            'display_title.*'=>'required|unique_translation:permissions',
        ];
    }

    public function messages()
    {
        if (languageLocale() == 'ar') {
            return [
                'title.required' => 'برجاء ادخال الاسم',
                'title.unique' => 'لا يمكن ادخال الاسم متكرر',
                'title.string' => 'لا يمكن ادخال غير الحروف',
                'display_title.*.required' => 'برجاء ادخال الاسم',
                'display_title.*.unique_translation' => 'لا يمكن ادخال الاسم متكرر',
            ];
        }
        else{
            return [];
        }
    }
}
