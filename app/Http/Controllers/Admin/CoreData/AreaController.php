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
        $datas = $this->areaRepository->getData();
        $country = $this->countryRepository->listData();
        return view(checkView('admin.core_data.area.index'), compact('datas','country'));
    }

    public function store(CreateRequest $request)
    {
        return response()->json($this->areaRepository->storeData($request));
    }

    public function update(EditRequest $request, $id)
    {
        return response()->json($this->areaRepository->updateData($request, $id));
    }

    public function changeStatus($id)
    {
        $this->areaRepository->updateStatusData($id);
    }

    public function destroy($id)
    {
        $this->areaRepository->deleteData($id);
    }

    public function remove($id)
    {;
        $this->areaRepository->removeData($id);
    }

    public function destroyIndex()
    {
        $datas = $this->areaRepository->getDataDelete();
        return view(checkView('admin.core_data.area.destroy'), compact('datas'));
    }

    public function restore($id)
    {
        $this->areaRepository->restoreData($id);
    }

    public function listIndex($country,$city)
    {
        return $this->areaRepository->listData($country,$city);
    }

    public function show($id)
    {
        return $this->areaRepository->showData($id);
    }
}
