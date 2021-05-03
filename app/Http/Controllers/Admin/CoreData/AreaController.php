<?php

namespace App\Http\Controllers\Admin\CoreData;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CoreData\Area\CreateRequest;
use App\Http\Requests\Admin\CoreData\Area\EditRequest;
use App\Repositories\Admin\CoreData\AreaRepository;
use App\Repositories\Admin\CoreData\CountryRepository;

class AreaController extends Controller
{
    private $areaRepository,$countryRepository;

    public function __construct(AreaRepository $AreaRepository,CountryRepository $CountryRepository)
    {
        $this->areaRepository = $AreaRepository;
        $this->countryRepository = $CountryRepository;
    }

    public function index()
    {
        $datas = $this->areaRepository->Get_All_Data();
        $country = $this->countryRepository->List_Data();
        return view(check_view('admin.core_data.area.index'), compact('datas','country'));
    }

    public function store(CreateRequest $request)
    {
        return response()->json($this->areaRepository->Create_Data($request));
    }

    public function update(EditRequest $request, $id)
    {
        return response()->json($this->areaRepository->Update_Data($request, $id));
    }

    public function change_status($id)
    {
        $this->areaRepository->Update_Status_Data($id);
    }

    public function destroy($id)
    {
        $this->areaRepository->Delete_Data($id);
    }

    public function remove($id)
    {;
        $this->areaRepository->Remove_Data($id);
    }

    public function destroy_index()
    {
        $datas = $this->areaRepository->Get_All_Data_Delete();
        return view(check_view('admin.core_data.area.destroy'), compact('datas'));
    }

    public function restore($id)
    {
        $this->areaRepository->Back_Data_Delete($id);
    }

    public function list_all($country,$city)
    {
        return $this->areaRepository->List_Data($country,$city);
    }

    public function show($id)
    {
        return $this->areaRepository->Get_Data($id);
    }
}
