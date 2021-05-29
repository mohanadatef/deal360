<?php

namespace App\Http\Requests\Admin\CoreData\Type;

use App\Models\CoreData\Type;
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
            'order' => 'required|numeric|unique:types',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ];
        foreach (language() as $lang) {
            if ($lang->code == 'en') {
                $rules['title.' . $lang->code] = ['required', 'string',
                    Rule::unique('translations', 'value')
                        ->where('category_type', Type::class)
                        ->where('key', 'title')
                        ->where('language_id', $lang->id)
                ];
            } else {
                $rules['title.' . $lang->code] = [
                    Rule::unique('translations', 'value')
                        ->where('category_type', Type::class)
                        ->where('key', 'title')
                        ->where('language_id', $lang->id)
                ];
            }
        }
        return $rules;
    }
}
