<?php

namespace App\Http\Requests\Admin\Acl\Role;

use App\Models\Acl\Role;
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
        $rules = [
            'type_access' => 'required|string',
            'code' => 'required|string|unique:roles',
            'order' => 'required|numeric|unique:roles',
            'permission' => 'required|exists:permissions,id',
        ];
        foreach (language() as $lang) {
            if ($lang->code == 'en') {
                $rules['title.' . $lang->code] = ['required', 'string',
                    Rule::unique('translations', 'value')
                        ->where('category_type', Role::class)
                        ->where('key', 'title')
                        ->where('language_id', $lang->id)
                ];
            } else {
                $rules['title.' . $lang->code] = [
                    Rule::unique('translations', 'value')
                        ->where('category_type', Role::class)
                        ->where('key', 'title')
                        ->where('language_id', $lang->id)
                ];
            }
        }
        return $rules;
    }
}
