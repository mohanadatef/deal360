<?php

    namespace App\Http\Controllers\Api\Acl;

    use App\Http\Controllers\Controller;
    use App\Http\Resources\Acl\Agency\AgencyCardResource;
    use App\Http\Resources\Acl\Agency\AgencyResource;
    use App\Repositories\Acl\AgencyRepository;
    use Illuminate\Http\Request;

    class AgencyController extends Controller
    {
        private $agencyRepository;

        public function __construct(AgencyRepository $AgencyRepository)
        {
            $this->agencyRepository=$AgencyRepository; //variable agency repository
        }

        //get all agency available
        public function index(Request $request)
        {
            $request->request->add(['status' => 1]);
            $agency=$this->agencyRepository->getData($request);
            $paginate=['total_pages'=>ceil($agency->Total()/$agency->PerPage()),'current_page'=>$agency->CurrentPage(),'url_page'=>url('admin/agency?page=')];
            $agency= AgencyCardResource::collection($agency);
            return response(['status' => 1, 'data' => ['data'=>$agency,'paginate'=>$paginate], 'message' => trans('lang.Done')], 200);
        }

        //get one for agency by id
        public function show(Request $request)
        {
            $agency= new AgencyResource($this->agencyRepository->showData($request->id));//return one
            return response(['status' => 1, 'data' => $agency, 'message' => trans('lang.Done')], 200);
        }
    }
