<?php

namespace App\Http\Requests\Admin\Acl\Permission;

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
                'title'=>'required|unique:permissions,title,'.$this->id.',id',
                'display_title.*'=>'required|unique_translation:permissions,display_title,'.$this->id,
            ];

    }
    public function messages()
    {
        if (languageLocale() == 'ar') {
            return [
                'title.required' => 'برجاء ادخال الاسم',
                'title.unique' => 'لا يمكن ادخال الاسم متكرر',
                'display_title.*.required' => 'برجاء ادخال الاسم',
                'display_title.*.unique_translation' => 'لا يمكن ادخال الاسم متكرر',
            ];
        }
        else{
            return [];
        }
    }
}
