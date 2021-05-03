<?php

namespace App\Http\Requests\Admin\Setting\Setting;

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
            'title.*'=>'required|unique_translation:settings,title,'.$this->id,
            'facebook'=> 'required',
            'youtube'=> 'required',
            'twitter'=> 'required',
            'instagram'=> 'required',
            'app_google'=> 'required',
            'app_ios'=> 'required',
            'logo'=> 'image|mimes:jpg,jpeg,png,gif|max:2048',
        ];
    }
    public function messages()
    {
        return Language_Locale() == 'ar' ? [
                'title.*.required' => 'برجاء ادخال الاسم',
                'title.*.unique_translation' => 'لا يمكن ادخال الاسم متكرر',
                'facebook.required' => 'برجاء ادخال فيس بوك',
                'youtube.required' => 'برجاء ادخال اليوتيوب',
                'twitter.required' => 'برجاء ادخال تويتر',
                'app_ios.required' => 'برجاء ادخال متجر ابل',
                'app_google.required' => 'برجاء ادخال متجر جوجل',
                'instagram.required' => 'برجاء ادخال انستجرام',
                'logo.mimes' => 'برجاء ادخال الصوره jpg,jpeg,png,gif',
                'logo.max' => 'برجاء ادخال الصوره اقل من 2048',
        ] : [];
    }
}
