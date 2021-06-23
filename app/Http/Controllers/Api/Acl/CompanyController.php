<?php

    namespace App\Http\Controllers\Api\Acl;

    use App\Http\Controllers\Controller;
    use App\Http\Resources\Acl\Company\PropertyCardResource;
    use App\Http\Resources\Acl\Company\PropertyResource;
    use App\Repositories\Acl\CompanyRepository;
    use Illuminate\Http\Request;

    class CompanyController extends Controller
    {
        private $companyRepository;

        public function __construct(CompanyRepository $CompanyRepository)
        {
            $this->companyRepository=$CompanyRepository; //variable company repository
        }

        //get all company available
        public function index(Request $request)
        {
            $paginate=[];
            $request->request->add(['status' => 1]);
            $company=$this->companyRepository->getData($request);
            $paginate=['total_pages'=>ceil($company->Total()/$company->PerPage()),'current_page'=>$company->CurrentPage(),'url_page'=>url('admin/company?page=')];
            $company= PropertyCardResource::collection($company);
            return response(['status' => 1, 'data' => ['company'=>$company,'paginate'=>$paginate], 'message' => trans('lang.Done')], 200);
        }

        //get one for company by id
        public function show(Request $request)
        {
            $company= new PropertyResource($this->companyRepository->showData($request->id,$request->role_id));//return one
            return response(['status' => 1, 'data' => $company, 'message' => trans('lang.Done')], 200);
        }
    }
