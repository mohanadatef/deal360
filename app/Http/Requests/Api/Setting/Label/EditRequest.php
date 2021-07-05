<?php

namespace App\Http\Requests\Api\Setting\Label;

use App\Models\Setting\Label;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
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
            'key' => 'required|string|unique:labels,key,'.$this->id.',id',
        ];
        foreach(language() as $lang)
        {
            $rules['title.'.$lang->code] = ['required','string',
                Rule::unique('translations','value')
                    ->ignore($this->id, 'category_id')
                    ->where('category_type',Label::class)
                    ->where('key','title')
                    ->where('language_id',$lang->id)
            ];
        }
        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response(['status' => 0, 'data' => [], 'message' => $validator->errors()]));
    }

}
