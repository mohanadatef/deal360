<?php

namespace App\Http\Requests\Admin\CoreData\Language;

use Illuminate\Foundation\Http\FormRequest;

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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
            return [
                'code'=> 'required|string|unique:languages,code,'.$this->id.',id',
                'title'=> 'required|string|unique:languages,title,'.$this->id.',id',
                'order'=> 'required|numeric|unique:languages,order,'.$this->id.',id',
                'image'=> 'image|mimes:jpg,jpeg,png,gif|max:2048',
            ];

    }

}
