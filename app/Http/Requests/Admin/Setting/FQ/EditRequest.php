<?php

namespace App\Http\Requests\Admin\Setting\FQ;

use App\Models\setting\FQ;
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
            'order' => 'required|numeric|unique:fqs,order,'.$this->id.',id',
        ];
        foreach(language() as $lang)
        {
            $rules['question.'.$lang->code] = ['required','string',
                Rule::unique('translations','value')
                    ->ignore($this->id, 'category_id')
                    ->where('category_type',FQ::class)
                    ->where('key','question')
                    ->where('language_id',$lang->id)
            ];
            $rules['answer.'.$lang->code] = ['required','string',
                Rule::unique('translations','value')
                    ->ignore($this->id, 'category_id')
                    ->where('category_type',FQ::class)
                    ->where('key','answer')
                    ->where('language_id',$lang->id)
            ];
        }
        return $rules;
    }

}
