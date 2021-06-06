<?php

namespace App\Http\Controllers\Admin\Acl;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Acl\Agent\CreateRequest;
use App\Http\Requests\Admin\Acl\Agent\EditRequest;
use App\Repositories\Admin\Acl\AgentRepository;
use App\Repositories\Admin\Acl\CompanyRepository;
use App\Repositories\Admin\CoreData\CountryRepository;

class CompanyController extends Controller
{
    private $companyRepository;

    public function __construct(CompanyRepository $CompanyRepository)
    {
        $this->companyRepository = $CompanyRepository;
    }
    
	public function listIndex()
	{
		return $this->companyRepository->listData();
	}
}
