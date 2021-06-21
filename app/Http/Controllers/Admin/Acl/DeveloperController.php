<?php

namespace App\Http\Controllers\Admin\Acl;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Acl\Developer\CreateRequest;
use App\Http\Requests\Admin\Acl\Developer\EditRequest;
use App\Repositories\Admin\Acl\DeveloperRepository;
use App\Repositories\Admin\CoreData\CountryRepository;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    private $developerRepository;
    private $countryRepository;

    public function __construct(DeveloperRepository $DeveloperRepository,CountryRepository $CountryRepository)
    {
        $this->developerRepository = $DeveloperRepository;
        $this->countryRepository = $CountryRepository;
        $this->middleware(['permission:developer-list', 'permission:acl-list'])->except('listIndex');
        $this->middleware('permission:developer-index')->only('index');
        $this->middleware('permission:developer-create')->only('create', 'store');
        $this->middleware('permission:developer-edit')->only('edit', 'update');
        $this->middleware('permission:developer-status')->only('changeStatus');
        $this->middleware('permission:developer-delete')->only('destroy');
        $this->middleware('permission:developer-index-delete')->only('destroyIndex');
        $this->middleware('permission:developer-restore')->only('restore');
        $this->middleware('permission:developer-remove')->only('remove');
    }

    public function index(Request $request)
    {
        $datas = $this->developerRepository->getData($request);
        $paginator = ['total_pages' => ceil($datas->Total() / $datas->PerPage()),
            'current_page' => $datas->CurrentPage(),
            'url_page' => url('admin/developer?page=')];
        return view(checkView('admin.acl.developer.index'), compact('datas', 'paginator'));
    }

    public function create()
    {
        $country = $this->countryRepository->listData();
        return view(checkView('admin.acl.developer.create'), compact( 'country'));
    }

    public function store(CreateRequest $request)
    {
        $this->developerRepository->storeData($request);
        return redirect(route('developer.index'))->with(trans('Done'));
    }

    public function edit($id)
    {
        $data = $this->developerRepository->showData($id);
        $country = $this->countryRepository->listData();
        return view(checkView('admin.acl.developer.edit'), compact('data',  'country'));
    }

    public function update(EditRequest $request, $id)
    {
        $this->developerRepository->updateData($request, $id);
        return redirect(route('developer.index'))->with(trans('Done'));
    }

    public function changeStatus($id)
    {
        $this->developerRepository->updateStatusData($id);
    }

	public function changeApprove($id)
	{
		$this->developerRepository->updateApproveData($id);
	}

    public function destroy($id)
    {
        $this->developerRepository->deleteData($id);
    }

    public function remove($id)
    {
        ;
        $this->developerRepository->removeData($id);
    }

    public function destroyIndex()
    {
        $datas = $this->developerRepository->getDataDelete();
        $paginator = ['total_pages' => ceil($datas->Total() / $datas->PerPage()),
            'current_page' => $datas->CurrentPage(),
            'url_page' => url('admin/developer?page=')];
        return view(checkView('admin.acl.developer.destroy'), compact('datas','paginator'));
    }

    public function restore($id)
    {
        $this->developerRepository->restoreData($id);
    }

	public function listIndex()
	{
		return $this->developerRepository->listData();
	}
}
