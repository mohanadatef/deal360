<?php

namespace App\Http\Requests\Admin\Acl\Developer;

use App\Models\Acl\Developer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}
	
	/**
	 * Get the validation rules that apply to the request.
	 * @return array
	 */
	public function rules()
	{
		$rules=['fullname'=>'required|string|unique:users','username'=>'required|string|unique:users',
		        'email'   =>'required|email|unique:users','phone'=>'required|numeric|unique:users',
		        'facebook'=>'string|nullable','instagram'=>'string|nullable','youtube'=>'string|nullable',
		        'twitter' =>'string|nullable','website'=>'string|nullable','country_id'=>'required|exists:countries,id',
		        'password'=>'required|string|min:6|confirmed',
		        'image'   =>'required|image|mimes:jpg,jpeg,png,gif|max:2048',];
		foreach(language() as $lang)
		{
			if($lang->code == 'en')
			{
				$rules['address.'.$lang->code]=['required','string',Rule::unique('translations','value')
					->where('category_type',Developer::class)->where('key','address')->where('language_id',$lang->id)];
				$rules['about_me.'.$lang->code]=['required','string',Rule::unique('translations','value')
					->where('category_type',Developer::class)->where('key','about_me')->where('language_id',$lang->id)];
			}else
			{
				$rules['address.'.$lang->code]=[Rule::unique('translations','value')
					                                ->where('category_type',Developer::class)->where('key','address')
					                                ->where('language_id',$lang->id)];
				$rules['about_me.'.$lang->code]=[Rule::unique('translations','value')
					                                 ->where('category_type',Developer::class)->where('key','about_me')
					                                 ->where('language_id',$lang->id)];
			}
		}
		return $rules;
	}
}
