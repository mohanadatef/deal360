<?php

namespace App\Repositories\Admin\Acl;

use App\Http\Resources\Admin\Acl\Agent\AgentListResource;
use App\Interfaces\Admin\Acl\UserInterface;
use App\Models\Acl\Agent;
use App\Traits\Image;
use App\Traits\ServiceData;
use Illuminate\Support\Facades\DB;

class AgentRepository implements UserInterface
{
	use ServiceData,Image;
	
	protected $data,$userRepository;
	
	public function __construct(Agent $Agent,UserRepository $UserRepository)
	{
		$this->data=$Agent;
		$this->userRepository=$UserRepository;
	}
	
	public function getData()
	{
		return $this->data->with('user','company')->paginate(25);
	}
	
	public function storeData($request)
	{
		return DB::transaction(function() use ($request)
		{
			$request->request->add(['role_id'=>5]);
			$user['user_id']=$this->userRepository->storeData($request)->id;
			$data=$this->data->create(array_merge($request->all(),$user));
			foreach(language() as $lang)
			{
				if(isset($request->address[$lang->code]))
				{
					$data->translation()->create(['key'=>'address','value'=>$request->address[$lang->code],
					                              'language_id'=>$lang->id]);
				}else
				{
					$data->translation()->create(['key'        =>'address','value'=>$request->address['en'],
					                              'language_id'=>$lang->id]);
				}
				if(isset($request->about_me[$lang->code]))
				{
					$data->translation()->create(['key'        =>'about_me','value'=>$request->about_me[$lang->code],
					                              'language_id'=>$lang->id]);
				}else
				{
					$data->translation()->create(['key'        =>'about_me','value'=>$request->about_me['en'],
					                              'language_id'=>$lang->id]);
				}
			}
		});
	}
	
	public function showData($id)
	{
		return $this->data->with('user','about_me','address','company')->findorFail($id);
	}
	
	public function updateData($request,$id)
	{
		return DB::transaction(function() use ($request,$id)
		{
			$data=$this->showData($id);
			$data->update($request->all());
			$this->userRepository->updateData($request,$data->user_id);
			foreach(language() as $lang)
			{
				$translation=$data->translation->where('language_id',$lang->id)->where('key','about_me')->first();
				if($translation)
				{
					$translation->update(['value'=>$request->about_me[$lang->code]]);
				}else
				{
					if(isset($request->about_me[$lang->code]))
					{
						$data->translation()->create(['key'        =>'about_me',
						                              'value'      =>$request->about_me[$lang->code],
						                              'language_id'=>$lang->id]);
					}else
					{
						$data->translation()->create(['key'        =>'about_me','value'=>$request->about_me['en'],
						                              'language_id'=>$lang->id]);
					}
				}
				$translation=$data->translation->where('language_id',$lang->id)->where('key','address')->first();
				if($translation)
				{
					$translation->update(['value'=>$request->address[$lang->code]]);
				}else
				{
					if(isset($request->address[$lang->code]))
					{
						$data->translation()->create(['key'        =>'address','value'=>$request->address[$lang->code],
						                              'language_id'=>$lang->id]);
					}else
					{
						$data->translation()->create(['key'        =>'address','value'=>$request->address['en'],
						                              'language_id'=>$lang->id]);
					}
				}
			}
		});
	}
	
	public function updateStatusData($id)
	{
		$this->userRepository->updateStatusData($id);
	}
	
	public function updateApproveData($id)
	{
		$this->changeApprove($this->userRepository->showData($id));
	}
	
	public function deleteData($id)
	{
		$this->showData($id)->delete();
	}
	
	public function getDataDelete()
	{
		return $this->data->onlyTrashed()->with('user','company')->paginate(25);
	}
	
	public function restoreData($id)
	{
		$this->data->withTrashed()->find($id)->restore();
	}
	
	public function removeData($id)
	{
		$data=$this->data->withTrashed()->find($id);
		$data->forceDelete();
	}
	
	public function listData()
	{
		return AgentListResource::collection(DB::table('agents')->join('users','users.id','=','agents.user_id')
			->where('users.status',1)->where('users.approve',1)->orderby('users.fullname','asc')->select('users.fullname','agents.*')->get());
	}
}
