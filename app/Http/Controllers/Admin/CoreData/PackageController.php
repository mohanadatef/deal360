<?php

namespace App\Http\Controllers\Admin\CoreData;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CoreData\Package\CreateRequest;
use App\Http\Requests\Admin\CoreData\Package\EditRequest;
use App\Repositories\Admin\CoreData\PackageRepository;

class PackageController extends Controller
{
    private $packageRepository;

    public function __construct(PackageRepository $PackageRepository)
    {
        $this->packageRepository = $PackageRepository;
    }

    public function index()
    {
        $datas = $this->packageRepository->getAllData();
        return view(checkView('admin.core_data.package.index'), compact('datas'));
    }

    public function store(CreateRequest $request)
    {
        return response()->json($this->packageRepository->storeData($request));
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
        $datas = $this->packageRepository->getAllDataDelete();
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

    public function show($id)
    {
        return $this->packageRepository->showData($id);
    }
}
