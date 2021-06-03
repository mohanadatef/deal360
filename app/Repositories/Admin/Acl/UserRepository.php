<?php

namespace App\Repositories\Admin\Acl;

use App\Interfaces\Admin\Acl\AdminInterface;
use App\Models\Acl\User;
use App\Traits\Image;
use App\Traits\ServiceData;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class UserRepository implements AdminInterface
{
	use ServiceData,Image;
	
	protected $data;
	
	public function __construct(User $User)
	{
		$this->data=$User;
	}
	
	public function getData()
	{
		return $this->data->with('role','country','image')->whereKeyNot(1)->order('asc')->paginate(25);
	}
	
	public function storeData($request)
	{
		return DB::transaction(function() use ($request)
		{
			$data_auth['approve']=1;
			$data_auth['email_verified_at']=Carbon::now();
			$data=$this->data->create(array_merge($request->toarray(),$data_auth));
			$imageName=time().$request->image->getClientOriginalname();
			$image=$data->image()->create(['image'=>$imageName]);
			!$image->image?false:$this->uploadImage($request->image,'user',$imageName);
			return $data;
		});
	}
	
	public function showData($id)
	{
		return $this->data->with('role','country','image','agency')->findorFail($id);
	}
	
	public function updateData($request,$id)
	{
		return DB::transaction(function() use ($request,$id)
		{
			$data=$this->showData($id);
			$data->update($request->all());
			if(isset($request->image))
			{
				$this->deleteImage($data->image,'user');
				$imageName=time().$request->image->getClientOriginalname();
				$data->image()->forceDelete();
				$image=$data->image()->create(['image'=>$imageName]);
				!$image->image?false:$this->uploadImage($request->image,'user',$imageName);
			}
		});
	}
	
	public function updateStatusData($id)
	{
		$this->changeStatus($this->showData($id));
	}
	
	public function deleteData($id)
	{
		$this->showData($id)->delete();
	}
	
	public function getDataDelete()
	{
		return $this->data->onlyTrashed()->with('role','country','image')->order('asc')->paginate(25);
	}
	
	public function restoreData($id)
	{
		$this->data->withTrashed()->find($id)->restore();
	}
	
	public function removeData($id)
	{
		$data=$this->data->withTrashed()->find($id);
		$this->deleteImage($data->image,'user');
		$data->forceDelete();
	}
}
