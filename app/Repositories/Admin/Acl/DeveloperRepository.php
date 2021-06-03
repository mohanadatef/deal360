<?php

namespace App\Repositories\Admin\Acl;

use App\Http\Resources\Admin\Acl\Developer\DeveloperListResource;
use App\Interfaces\Admin\MeanInterface;
use App\Models\Acl\Developer;
use App\Traits\Image;
use App\Traits\ServiceData;
use Illuminate\Support\Facades\DB;

class DeveloperRepository implements MeanInterface
{
	use ServiceData,Image;
	
	protected $data,$userRepository;
	
	public function __construct(Developer $Developer,UserRepository $UserRepository)
	{
		$this->data=$Developer;
		$this->userRepository=$UserRepository;
	}
	
	public function getData()
	{
		return $this->data->with('user.country','user.image')->paginate(25);
	}
	
	public function storeData($request)
	{
		return DB::transaction(function() use ($request)
		{
			$request->request->add(['role_id'=>5]);
			$user['user_id']=$this->userRepository->storeData($request)->id;
			$data=$this->data->create($user);
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
		return $this->data->with('user','about_me','address')->findorFail($id);
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
	
	public function deleteData($id)
	{
		$this->showData($id)->delete();
	}
	
	public function getDataDelete()
	{
		return $this->data->onlyTrashed()->with('user')->paginate(25);
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
		return DeveloperListResource::collection(DB::table('developers')->join('users','users.id','=','developers.user_id')
			->where('users.status',1)->orderby('users.fullname','asc')->select('users.*','developers.*')->get());
	}
}