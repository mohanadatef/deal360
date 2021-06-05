<?php

namespace App\Repositories\Admin\Acl;

use App\Http\Resources\Admin\Acl\Company\CompanyListResource;
use App\Interfaces\Admin\Acl\CompanyInterface;
use Illuminate\Support\Facades\DB;

class CompanyRepository implements CompanyInterface
{
	public function __construct()
	{
	}
	
	public function listData()
	{
		return CompanyListResource::collection(DB::table('users')->join('agencies','agencies.user_id','=','users.id')
			->join('developers','developers.user_id','=','users.id')->wherein('users.role_id',[3,5])->where('users.status',1)->where('users.approve',1)
			->orderby('users.fullname','asc')->select('users.id','users.fullname','agencies.id as company_id','developers.id as company_id')->get());
	}
}
