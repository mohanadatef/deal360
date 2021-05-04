<?php

namespace App\Http\Controllers\Admin\CoreData;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CoreData\City\CreateRequest;
use App\Http\Requests\Admin\CoreData\City\EditRequest;
use App\Repositories\Admin\CoreData\CityRepository;
use App\Repositories\Admin\CoreData\CountryRepository;

class CityController extends Controller
{
    private $cityRepository,$countryRepository;

    public function __construct(CityRepository $CityRepository,CountryRepository $CountryRepository)
    {
        $this->cityRepository = $CityRepository;
        $this->countryRepository = $CountryRepository;
    }

    public function index()
    {
        $datas = $this->cityRepository->Get_All_Data();
        $country = $this->countryRepository->List_Data();
        return view(check_view('admin.core_data.city.index'), compact('datas','country'));
    }

    public function store(CreateRequest $request)
    {
        return response()->json($this->cityRepository->Create_Data($request));
    }

    public function update(EditRequest $request, $id)
    {
        return response()->json($this->cityRepository->Update_Data($request, $id));
    }

    public function change_status($id)
    {
        $this->cityRepository->Update_Status_Data($id);
    }

    public function destroy($id)
    {
        $this->cityRepository->Delete_Data($id);
    }

    public function remove($id)
    {;
        $this->cityRepository->Remove_Data($id);
    }

    public function destroy_index()
    {
        $datas = $this->cityRepository->Get_All_Data_Delete();
        return view(check_view('admin.core_data.city.destroy'), compact('datas'));
    }

    public function restore($id)
    {
        $this->cityRepository->Back_Data_Delete($id);
    }

    public function list_all($country)
    {
        return $this->cityRepository->List_Data($country);
    }

    public function show($id)
    {
        return $this->cityRepository->Get_Data($id);
    }
}
