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
        $datas = $this->cityRepository->getAllData();
        $country = $this->countryRepository->listData();
        return view(checkView('admin.core_data.city.index'), compact('datas','country'));
    }

    public function store(CreateRequest $request)
    {
        return response()->json($this->cityRepository->storeData($request));
    }

    public function update(EditRequest $request, $id)
    {
        return response()->json($this->cityRepository->updateData($request, $id));
    }

    public function changeStatus($id)
    {
        $this->cityRepository->updateStatusData($id);
    }

    public function destroy($id)
    {
        $this->cityRepository->deleteData($id);
    }

    public function remove($id)
    {;
        $this->cityRepository->removeData($id);
    }

    public function destroyIndex()
    {
        $datas = $this->cityRepository->getAllDataDelete();
        return view(checkView('admin.core_data.city.destroy'), compact('datas'));
    }

    public function restore($id)
    {
        $this->cityRepository->restoreData($id);
    }

    public function listIndex($country)
    {
        return $this->cityRepository->listData($country);
    }

    public function show($id)
    {
        return $this->cityRepository->showData($id);
    }
}
