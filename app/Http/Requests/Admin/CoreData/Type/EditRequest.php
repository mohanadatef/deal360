<?php

namespace App\Http\Requests\Admin\CoreData\Type;

use App\Models\CoreData\Type;
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
    public function rules()
    {
        $rules = [
            'order' => 'required|numeric|unique:types,order,'.$this->id.',id',
            'image'=> 'image|mimes:jpg,jpeg,png,gif|max:2048',
        ];
        foreach(language() as $lang)
        {
            $rules['title.'.$lang->code] = ['required','string',
                Rule::unique('translations','value')
                    ->ignore($this->id, 'category_id')
                    ->where('category_type',Type::class)
                    ->where('key','title')
                    ->where('language_id',Language_code($lang->code)->id)
            ];
        }
        return $rules;
    }

}
