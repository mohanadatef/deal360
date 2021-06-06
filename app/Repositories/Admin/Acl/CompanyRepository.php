<?php

namespace App\Repositories\Admin\Acl;

use App\Http\Resources\Admin\Acl\Company\CompanyListResource;
use App\Interfaces\Admin\Acl\CompanyInterface;
use Illuminate\Support\Facades\DB;

class CompanyRepository implements CompanyInterface
{
	public function listData()
	{
		return CompanyListResource::collection(DB::table('users')
			->wherein('users.role_id',[4,6])
			->where('users.status',1)
			->where('users.approve',1)
			->leftjoin('agencies','agencies.user_id','=','users.id')
			->leftjoin('developers','developers.user_id','=','users.id')
			->orderby('users.fullname','asc')
			->select('users.id','users.fullname',
				'agencies.id as company_id','developers.id as company_id1')->get());
	}
}
