<?php

namespace App\Http\Requests\Admin\CoreData\Language;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'title' => 'required|string|unique:languages',
            'code' => 'required|string|unique:languages',
            'order' => 'required|numeric|unique:languages',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ];
    }


}
