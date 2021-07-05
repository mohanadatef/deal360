<?php

namespace App\Http\Requests\Admin\Acl\Developer;

use App\Models\Acl\Developer;
use App\Repositories\Acl\DeveloperRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditRequest extends FormRequest
{
	private $developerRepository;

	public function __construct(DeveloperRepository $DeveloperRepository)
	{
		parent::__construct();
		$this->developerRepository=$DeveloperRepository;
	}

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
		$developer=$this->developerRepository->showData($this->id)->user_id;
		$rules=['fullname'=>'required|string|unique:users,fullname,'.$developer.',id',
		        'email'   =>'required|email|unique:users,email,'.$developer.',id',
		        'phone'   =>'required|numeric|unique:users,phone,'.$developer.',id',
		        'country_id' =>'required|exists:countries,id','image'=>'image|mimes:jpg,jpeg,png,gif|max:2048',
		        'facebook'=>'string|nullable','instagram'=>'string|nullable','youtube'=>'string|nullable',
		        'twitter' =>'string|nullable','website'=>'string|nullable'];
		foreach(language() as $lang)
		{
			$rules['address.'.$lang->code]=['string',
			                                Rule::unique('translations','value')->ignore($this->id,'category_id')
				                                ->where('category_type',Developer::class)->where('key','address')
				                                ->where('language_id',$lang->id)];
			$rules['about_me.'.$lang->code]=['string',
			                                 Rule::unique('translations','value')->ignore($this->id,'category_id')
				                                 ->where('category_type',Developer::class)->where('key','about_me')
				                                 ->where('language_id',$lang->id)];
		}
		return $rules;
	}
}
