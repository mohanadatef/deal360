<?php

namespace App\Http\Requests\Admin\Acl\Agent;

use App\Models\Acl\Agent;
use App\Repositories\Admin\Acl\AgentRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditRequest extends FormRequest
{
	private $agentRepository;
	
	public function __construct(AgentRepository $AgentRepository)
	{
		$this->agentRepository=$AgentRepository;
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
		$agent=$this->agentRepository->showData($this->id)->user_id;
		$rules=['fullname'=>'required|string|unique:users,fullname,'.$agent.',id',
		        'email' =>'required|email|unique:users,email,'.$agent.',id',
		        'phone' =>'required|numeric|unique:users,phone,'.$agent.',id',
		        'country_id' =>'required|exists:countries,id',
		        'image'=>'image|mimes:jpg,jpeg,png,gif|max:2048',
		        'facebook'=>'string|nullable',
		        'instagram'=>'string|nullable',
		        'youtube'=>'string|nullable',
		        'twitter' =>'string|nullable',
		        'website'=>'string|nullable',
		        'company_id'=>'required'];
		foreach(language() as $lang)
		{
			$rules['address.'.$lang->code]=['required','string',
			                                Rule::unique('translations','value')->ignore($this->id,'category_id')
				                                ->where('category_type',Agent::class)->where('key','address')
				                                ->where('language_id',$lang->id)];
			$rules['about_me.'.$lang->code]=['required','string',
			                                 Rule::unique('translations','value')->ignore($this->id,'category_id')
				                                 ->where('category_type',Agent::class)->where('key','about_me')
				                                 ->where('language_id',$lang->id)];
		}
		return $rules;
	}
}
