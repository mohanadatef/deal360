<?php

namespace App\Http\Requests\Admin\CoreData\Package;

use App\Models\CoreData\Package;
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
            'order' => 'required|numeric|unique:packages,order,'.$this->id.',id',
            'count_listing' => 'required|numeric',
            'type_date' => 'required|string',
            'count_date' => 'required|numeric',
        ];
        foreach(language() as $lang)
        {
            $rules['title.'.$lang->code] = ['required','string',
                Rule::unique('translations','value')
                    ->ignore($this->id, 'category_id')
                    ->where('category_type',Package::class)
                    ->where('key','title')
                    ->where('language_id',Language_code($lang->code)->id)
            ];
        }
        return $rules;
    }

}
