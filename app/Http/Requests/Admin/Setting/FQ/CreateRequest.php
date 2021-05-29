<?php

namespace App\Http\Requests\Admin\Setting\FQ;

use App\Models\Setting\FQ;
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
            'order' => 'required|numeric|unique:fqs',
        ];
        foreach(language() as $lang)
        {
            if ($lang->code == 'en') {
                $rules['question.' . $lang->code] = ['required', 'string',
                    Rule::unique('translations', 'value')
                        ->where('category_type', FQ::class)
                        ->where('key', 'question')
                        ->where('language_id', $lang->id)
                ];
                $rules['answer.' . $lang->code] = ['required', 'string',
                    Rule::unique('translations', 'value')
                        ->where('category_type', FQ::class)
                        ->where('key', 'answer')
                        ->where('language_id', $lang->id)
                ];
            }else{
                $rules['question.' . $lang->code] = [
                    Rule::unique('translations', 'value')
                        ->where('category_type', FQ::class)
                        ->where('key', 'question')
                        ->where('language_id', $lang->id)
                ];
                $rules['answer.' . $lang->code] = [
                    Rule::unique('translations', 'value')
                        ->where('category_type', FQ::class)
                        ->where('key', 'answer')
                        ->where('language_id', $lang->id)
                ];
            }
        }
        return $rules;
    }


}
