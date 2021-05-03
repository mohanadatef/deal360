<?php

namespace App\Http\Requests\Admin\CoreData\Package;

use App\Models\CoreData\Package;
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
            'order' => 'required|numeric|unique:packages',
            'count_listing' => 'required|numeric',
            'type_date' => 'required|string',
            'count_date' => 'required|numeric',
        ];
        foreach(language() as $lang)
        {
            $rules['title.'.$lang->code] = ['required','string',
                Rule::unique('translations','value')
                ->where('category_type',Package::class)
                ->where('key','title')
                ->where('language_id',Language_code($lang->code)->id)
            ];
        }
        return $rules;
    }


}
