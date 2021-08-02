<?php

    namespace App\Http\Controllers\Api\Acl;

    use App\Events\Api\Setting\ViewEvent;
    use App\Http\Controllers\Controller;
    use App\Http\Resources\Acl\Company\CompanyCardResource;
    use App\Http\Resources\Acl\Company\CompanyResource;
    use App\Http\Resources\Acl\Company\CompanyPropertyResource;
    use App\Models\Acl\User;
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
            $request->request->add(['web' => 1]);
            $company=$this->companyRepository->getData($request);
            $paginate=['total_pages'=>ceil($company->Total()/$company->PerPage()),'current_page'=>$company->CurrentPage(),'url_page'=>url('admin/company?page=')];
            $company= CompanyCardResource::collection($company);
            return response(['status' => 1, 'data' => ['company'=>$company,'paginate'=>$paginate], 'message' => trans('lang.Done')], 200);
        }

        //get one for company by id
        public function show(Request $request)
        {
            if ($request->property==1){
                $company= new CompanyPropertyResource($this->companyRepository->propertyData($request->id,$request->role_id));//return one
            }else{
                $company= new CompanyResource($this->companyRepository->showData($request->id,$request->role_id));//return one
            }
            if (isset($request->auth_id) && !empty($request->auth_id)) {
                event(new ViewEvent($company->user->id, User::class, $request->ip(), $request->auth_id));
            }
            return response(['status' => 1, 'data' => $company, 'message' => trans('lang.Done')], 200);
        }
    }
