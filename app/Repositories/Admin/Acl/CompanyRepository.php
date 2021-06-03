<?php

namespace App\Repositories\Admin\Acl;

use App\Interfaces\Admin\Acl\CompanyInterface;

class CompanyRepository implements CompanyInterface
{
	public function __construct()
	{
	
	}
	
	public function listData()
	{
		return CompanyListResource::collection();
	}
}
