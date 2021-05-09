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
        $datas = $this->countryRepository->getData();
        return view(checkView('admin.core_data.country.index'), compact('datas'));
    }

    public function store(CreateRequest $request)
    {
        return response()->json($this->countryRepository->storeData($request));
    }

    public function update(EditRequest $request, $id)
    {
        return response()->json($this->countryRepository->updateData($request, $id));
    }

    public function changeStatus($id)
    {
        $this->countryRepository->updateStatusData($id);
    }

    public function destroy($id)
    {
        $this->countryRepository->deleteData($id);
    }

    public function remove($id)
    {;
        $this->countryRepository->removeData($id);
    }

    public function destroyIndex()
    {
        $datas = $this->countryRepository->getDataDelete();
        return view(checkView('admin.core_data.country.destroy'), compact('datas'));
    }

    public function restore($id)
    {
        $this->countryRepository->restoreData($id);
    }

    public function listIndex()
    {
        return $this->countryRepository->listData();
    }

    public function show($id)
    {
        return $this->countryRepository->showData($id);
    }
}
