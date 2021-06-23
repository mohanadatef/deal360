<?php

namespace App\Http\Controllers\Admin\Acl;

use App\Http\Controllers\Controller;
use App\Repositories\Acl\CompanyRepository;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    private $companyRepository;

    public function __construct(CompanyRepository $CompanyRepository)
    {
        $this->companyRepository = $CompanyRepository;
    }

	public function listIndex(Request $request)
	{
		return $this->companyRepository->listData($request);
	}
}
