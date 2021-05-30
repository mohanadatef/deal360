<?php

namespace App\Http\Controllers\Admin\CoreData;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CoreData\Package\CreateRequest;
use App\Http\Requests\Admin\CoreData\Package\EditRequest;
use App\Repositories\Admin\Acl\RoleRepository;
use App\Repositories\Admin\CoreData\CurrencyRepository;
use App\Repositories\Admin\CoreData\PackageRepository;

class PackageController extends Controller
{
    private $packageRepository;
    private $roleRepository;
    private $currencyRepository;

    public function __construct(PackageRepository $PackageRepository,RoleRepository $RoleRepository,
                                CurrencyRepository $CurrencyRepository)
    {
        $this->packageRepository = $PackageRepository;
        $this->roleRepository = $RoleRepository;
        $this->currencyRepository = $CurrencyRepository;
        $this->middleware(['permission:package-list','permission:core-data-list'])->except('listIndex');
        $this->middleware('permission:package-index')->only('index');
        $this->middleware('permission:package-create')->only('create','store');
        $this->middleware('permission:package-edit')->only('edit','update');
        $this->middleware('permission:package-status')->only('changeStatus');
        $this->middleware('permission:package-delete')->only('destroy');
        $this->middleware('permission:package-index-delete')->only('destroyIndex');
        $this->middleware('permission:package-restore')->only('restore');
        $this->middleware('permission:package-remove')->only('remove');
    }

    public function index()
    {
        $datas = $this->packageRepository->getData();
        return view(checkView('admin.core_data.package.index'), compact('datas'));
    }

    public function create()
    {
        $role = $this->roleRepository->listData();
        $currency = $this->currencyRepository->listData();
        return view(checkView('admin.core_data.package.create'),compact('role','currency'));
    }

    public function store(CreateRequest $request)
    {
        return response()->json($this->packageRepository->storeData($request));
    }

    public function edit($id)
    {
        $role = $this->roleRepository->listData();
        $currency = $this->currencyRepository->listData();
        $data = $this->packageRepository->showData($id);
        return view(checkView('admin.core_data.package.edit'),compact('data','role','currency'));
    }

    public function update(EditRequest $request, $id)
    {
        return response()->json($this->packageRepository->updateData($request, $id));
    }

    public function changeStatus($id)
    {
        $this->packageRepository->updateStatusData($id);
    }

    public function destroy($id)
    {
        $this->packageRepository->deleteData($id);
    }

    public function remove($id)
    {
        $this->packageRepository->removeData($id);
    }

    public function destroyIndex()
    {
        $datas = $this->packageRepository->getDataDelete();
        return view(checkView('admin.core_data.package.destroy'), compact('datas'));
    }

    public function restore($id)
    {
        $this->packageRepository->restoreData($id);
    }

    public function listIndex()
    {
        return $this->packageRepository->listData();
    }
}
