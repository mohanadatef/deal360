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
        $this->agencyRepository = $AgencyRepository;
        $this->countryRepository = $CountryRepository;
        $this->middleware(['permission:agency-list', 'permission:acl-list'])->except('listIndex');
        $this->middleware('permission:agency-index')->only('index');
        $this->middleware('permission:agency-create')->only('create', 'store');
        $this->middleware('permission:agency-edit')->only('edit', 'update');
        $this->middleware('permission:agency-status')->only('changeStatus');
        $this->middleware('permission:agency-delete')->only('destroy');
        $this->middleware('permission:agency-index-delete')->only('destroyIndex');
        $this->middleware('permission:agency-restore')->only('restore');
        $this->middleware('permission:agency-remove')->only('remove');
    }

    public function index()
    {
        $datas = $this->agencyRepository->getData();
        $paginator = ['total_pages' => ceil($datas->Total() / $datas->PerPage()),
            'current_page' => $datas->CurrentPage(),
            'url_page' => url('admin/agency?page=')];
        return view(checkView('admin.acl.agency.index'), compact('datas', 'paginator'));
    }

    public function create()
    {
        $country = $this->countryRepository->listData();
        return view(checkView('admin.acl.agency.create'), compact( 'country'));
    }

    public function store(CreateRequest $request)
    {
        $this->agencyRepository->storeData($request);
        return redirect(route('agency.index'))->with(trans('Done'));
    }

    public function edit($id)
    {
        $data = $this->agencyRepository->showData($id);
        $country = $this->countryRepository->listData();
        return view(checkView('admin.acl.agency.edit'), compact('data',  'country'));
    }

    public function update(EditRequest $request, $id)
    {
        $this->agencyRepository->updateData($request, $id);
        return redirect(route('agency.index'))->with(trans('Done'));
    }

    public function changeStatus($id)
    {
        $this->agencyRepository->updateStatusData($id);
    }

    public function destroy($id)
    {
        $this->agencyRepository->deleteData($id);
    }

    public function remove($id)
    {
        ;
        $this->agencyRepository->removeData($id);
    }

    public function destroyIndex()
    {
        $datas = $this->agencyRepository->getDataDelete();
        $paginator = ['total_pages' => ceil($datas->Total() / $datas->PerPage()),
            'current_page' => $datas->CurrentPage(),
            'url_page' => url('admin/agency?page=')];
        return view(checkView('admin.acl.agency.destroy'), compact('datas','paginator'));
    }

    public function restore($id)
    {
        $this->agencyRepository->restoreData($id);
    }
	
	public function listIndex()
	{
		return $this->agencyRepository->listData();
	}
}
