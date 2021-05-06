<?php

namespace App\Http\Requests\Admin\Setting\CallUs;

use Illuminate\Foundation\Http\FormRequest;

class StatusEditRequest extends FormRequest
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
            'changeStatus' => 'required|exists:call_us,id',
        ];
    }

    public function messages()
    {
        return languageLocale() == 'ar' ? ['changeStatus.required' => 'برجاء الاختيار',]: [];
    }
}
