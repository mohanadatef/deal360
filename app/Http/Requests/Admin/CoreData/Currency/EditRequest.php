<?php

namespace App\Http\Requests\Admin\CoreData\Currency;

use App\Models\CoreData\Currency;
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
            'order' => 'required|numeric|unique:currencies,order,'.$this->id.',id',
            'country_id' => 'required|exists:countries,id',
        ];
        foreach(language() as $lang)
        {
            $rules['title.'.$lang->code] = ['required','string',
                Rule::unique('translations','value')
                    ->ignore($this->id, 'category_id')
                    ->where('category_type',Currency::class)
                    ->where('key','title')
                    ->where('language_id',$lang->id)
            ];
        }
        return $rules;
    }

}
