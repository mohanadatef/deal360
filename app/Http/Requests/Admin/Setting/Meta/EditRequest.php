<?php

namespace App\Http\Requests\Admin\setting\Meta;

use App\Models\setting\Meta;
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
            'order' => 'required|numeric|unique:metas,order,'.$this->id.',id',
        ];
        foreach(language() as $lang)
        {
            $rules['title.'.$lang->code] = ['required','string',
                Rule::unique('translations','value')
                    ->ignore($this->id, 'category_id')
                    ->where('category_type',Meta::class)
                    ->where('key','title')
                    ->where('language_id',$lang->id)
            ];
        }
        return $rules;
    }

}
