<?php

namespace App\Http\Requests\Admin\Acl\Agency;

use App\Models\Acl\Agency;
use App\Repositories\Acl\AgencyRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditRequest extends FormRequest
{
	private $agencyRepository;

	public function __construct(AgencyRepository $AgencyRepository)
	{
		parent::__construct();
		$this->agencyRepository=$AgencyRepository;
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
		$agency=$this->agencyRepository->showData($this->id)->user_id;
		$rules=['fullname'=>'required|string|unique:users,fullname,'.$agency.',id',
		        'email'   =>'required|email|unique:users,email,'.$agency.',id',
		        'phone'   =>'required|numeric|unique:users,phone,'.$agency.',id',
		        'country_id' =>'required|exists:countries,id','image'=>'image|mimes:jpg,jpeg,png,gif|max:2048',
		        'facebook'=>'string|nullable','instagram'=>'string|nullable','youtube'=>'string|nullable',
		        'twitter' =>'string|nullable','website'=>'string|nullable'];
		foreach(language() as $lang)
		{
			$rules['address.'.$lang->code]=['string',
			                                Rule::unique('translations','value')->ignore($this->id,'category_id')
				                                ->where('category_type',Agency::class)->where('key','address')
				                                ->where('language_id',$lang->id)];
			$rules['about_me.'.$lang->code]=['string',
			                                 Rule::unique('translations','value')->ignore($this->id,'category_id')
				                                 ->where('category_type',Agency::class)->where('key','about_me')
				                                 ->where('language_id',$lang->id)];
		}
		return $rules;
	}
}
