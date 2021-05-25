<?php

namespace App\Http\Requests\Admin\CoreData\Rejoin;

use App\Models\CoreData\Rejoin;
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
            'order' => 'required|numeric|unique:rejoins',
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
        ];
        foreach(language() as $lang)
        {
            $rules['title.'.$lang->code] = ['required','string',
                Rule::unique('translations','value')
                    ->where('category_type',Rejoin::class)
                    ->where('key','title')
                    ->where('language_id',$lang->id)
            ];
        }
        return $rules;
    }

}
