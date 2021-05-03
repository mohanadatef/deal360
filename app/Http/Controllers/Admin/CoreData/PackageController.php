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
        $datas = $this->packageRepository->Get_All_Data();
        return view(check_view('admin.core_data.package.index'), compact('datas'));
    }

    public function store(CreateRequest $request)
    {
        return response()->json($this->packageRepository->Create_Data($request));
    }

    public function update(EditRequest $request, $id)
    {
        return response()->json($this->packageRepository->Update_Data($request, $id));
    }

    public function change_status($id)
    {
        $this->packageRepository->Update_Status_Data($id);
    }

    public function destroy($id)
    {
        $this->packageRepository->Delete_Data($id);
    }

    public function remove($id)
    {
        $this->packageRepository->Remove_Data($id);
    }

    public function destroy_index()
    {
        $datas = $this->packageRepository->Get_All_Data_Delete();
        return view(check_view('admin.core_data.package.destroy'), compact('datas'));
    }

    public function restore($id)
    {
        $this->packageRepository->Back_Data_Delete($id);
    }

    public function list_all()
    {
        return $this->packageRepository->List_Data();
    }

    public function show($id)
    {
        return $this->packageRepository->Get_Data($id);
    }
}
