<?php
    
    namespace App\Http\Controllers\Admin\Acl;
    
    use App\Http\Controllers\Controller;
    use App\Http\Requests\Admin\Acl\Agency\CreateRequest;
    use App\Http\Requests\Admin\Acl\Agency\EditRequest;
    use App\Repositories\Admin\Acl\AgencyRepository;
    use App\Repositories\Admin\CoreData\CountryRepository;
    
    class AgencyController extends Controller
    {
        private $agencyRepository;
        private $countryRepository;
        
        public function __construct(AgencyRepository $AgencyRepository,CountryRepository $CountryRepository)
        {
            $this->agencyRepository=$AgencyRepository; //variable agency repository
            $this->countryRepository=$CountryRepository;//variable country repository
            //permission list use in this controller
            $this->middleware(['permission:agency-list','permission:acl-list'])->except('listIndex');//permission to open all thing for agency
            $this->middleware('permission:agency-index')->only('index');//permission to open index page agency
            $this->middleware('permission:agency-create')->only('create','store');//permission to open create page agency and store it
            $this->middleware('permission:agency-edit')->only('edit','update');//permission to to open edit page agency and update it
            $this->middleware('permission:agency-status')->only('changeStatus');//permission to change status agency
            $this->middleware('permission:agency-approve')->only('changeApprove');//permission to change approve agency
            $this->middleware('permission:agency-delete')->only('destroy');//permission to destroy agency
            $this->middleware('permission:agency-index-delete')->only('destroyIndex');//permission to open page index delete
            $this->middleware('permission:agency-restore')->only('restore');//permission to restore agency
            $this->middleware('permission:agency-remove')->only('remove');//permission to remove agency
        }
        
        //get all agency available
        public function index()
        {
            $datas=$this->agencyRepository->getData();//all data
            //paginator ( variable paginator => array with all information paginator )
            //total_pages => number of pages
            //current_page => number page you open it
            //url_page => url we will use it to paginator  ( variable page => number page )
            $paginator=['total_pages'=>ceil($datas->Total()/$datas->PerPage()),'current_page'=>$datas->CurrentPage(),'url_page'=>url('admin/agency?page=')];
            return view(checkView('admin.acl.agency.index'),compact('datas','paginator'));//go to index page with data and paginator
        }
        
        //open page to create agency
        public function create()
        {
            $country=$this->countryRepository->listData(); //all country
            return view(checkView('admin.acl.agency.create'),compact('country'));//go to create page with country
        }
        
        //store agency
        public function store(CreateRequest $request)//validation file for create (CreateRequest)
        {
            $this->agencyRepository->storeData($request); //send data to store
            return redirect(route('agency.index'))->with(trans('Done'));//go to index page with message Done
        }
        
        //open page to edit agency
        public function edit($id)//variable id
        {
            $data=$this->agencyRepository->showData($id); //get one data for agency by id
            $country=$this->countryRepository->listData(); //all country
            return view(checkView('admin.acl.agency.edit'),compact('data','country'));//go to edit page with data and country
        }
        
        //update agency
        public function update(EditRequest $request,$id)//validation file for edit (EditRequest)
        {
            $this->agencyRepository->updateData($request,$id); //send data to update with id we will update it
            return redirect(route('agency.index'))->with(trans('Done')); //go to index page with message Done
        }
        
        //change status agency
        public function changeStatus($id)//variable id
        {
            $this->agencyRepository->updateStatusData($id);//send id agency to change status
        }
        
        //change approve agency
        public function changeApprove($id)//variable id
        {
            $this->agencyRepository->updateApproveData($id);//send id agency to change approve
        }
        
        public function destroy($id)//variable id
        {
            $this->agencyRepository->deleteData($id);
        }
        
        public function remove($id)//variable id
        {
            ;
            $this->agencyRepository->removeData($id);
        }
        
        public function destroyIndex()
        {
            $datas=$this->agencyRepository->getDataDelete();
            $paginator=['total_pages'=>ceil($datas->Total()/$datas->PerPage()),'current_page'=>$datas->CurrentPage(),'url_page'=>url('admin/agency?page=')];
            return view(checkView('admin.acl.agency.destroy'),compact('datas','paginator'));
        }
        
        public function restore($id)//variable id
        {
            $this->agencyRepository->restoreData($id);
        }
        
        //grt list for agency to use it
        public function listIndex()
        {
            return $this->agencyRepository->listData();//return list
        }
    }
