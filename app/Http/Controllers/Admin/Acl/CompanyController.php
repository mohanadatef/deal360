<?php

namespace App\Http\Controllers\Admin\Acl;

use App\Http\Controllers\Controller;
use App\Repositories\Acl\CompanyRepository;

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
