<?php

namespace App\Http\Requests\Api\Setting\Label;

use App\Models\Setting\Label;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
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
            'key' => 'required|string|unique:labels,key',
        ];
        foreach (language() as $lang) {
                $rules['title.' . $lang->code] = ['required', 'string',
                    Rule::unique('translations', 'value')
                        ->where('category_type', Label::class)
                        ->where('key', 'title')
                        ->where('language_id', $lang->id)
                ];
        }
        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response(['status' => 0, 'data' => [], 'message' => $validator->errors()]));
    }
}
