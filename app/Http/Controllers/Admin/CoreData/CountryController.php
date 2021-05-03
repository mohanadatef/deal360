<?php

namespace App\Http\Controllers\Admin\CoreData;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CoreData\Country\CreateRequest;
use App\Http\Requests\Admin\CoreData\Country\EditRequest;
use App\Repositories\Admin\CoreData\CountryRepository;

class CountryController extends Controller
{
    private $countryRepository;

    public function __construct(CountryRepository $CountryRepository)
    {
        $this->countryRepository = $CountryRepository;
    }

    public function index()
    {
        $datas = $this->countryRepository->Get_All_Data();
        return view(check_view('admin.core_data.country.index'), compact('datas'));
    }

    public function store(CreateRequest $request)
    {
        return response()->json($this->countryRepository->Create_Data($request));
    }

    public function update(EditRequest $request, $id)
    {
        return response()->json($this->countryRepository->Update_Data($request, $id));
    }

    public function change_status($id)
    {
        $this->countryRepository->Update_Status_Data($id);
    }

    public function destroy($id)
    {
        $this->countryRepository->Delete_Data($id);
    }

    public function remove($id)
    {;
        $this->countryRepository->Remove_Data($id);
    }

    public function destroy_index()
    {
        $datas = $this->countryRepository->Get_All_Data_Delete();
        return view(check_view('admin.core_data.country.destroy'), compact('datas'));
    }

    public function restore($id)
    {
        $this->countryRepository->Back_Data_Delete($id);
    }

    public function list_all()
    {
        return $this->countryRepository->List_Data();
    }

    public function show($id)
    {
        return $this->countryRepository->Get_Data($id);
    }
}
