<?php

namespace App\Http\Requests\Admin\CoreData\Amenity;

use App\Models\CoreData\Amenity;
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
            'order' => 'required|numeric|unique:amenities',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ];
        foreach(language() as $lang)
        {
            $rules['title.'.$lang->code] = ['required','string',
                Rule::unique('translations','value')
                ->where('category_type',Amenity::class)
                ->where('key','title')
                ->where('language_id',$lang->id)
            ];
        }
        return $rules;
    }
}
