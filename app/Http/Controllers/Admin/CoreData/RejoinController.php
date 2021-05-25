<?php

namespace App\Http\Controllers\Admin\CoreData;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CoreData\Rejoin\CreateRequest;
use App\Http\Requests\Admin\CoreData\Rejoin\EditRequest;
use App\Repositories\Admin\CoreData\RejoinRepository;
use App\Repositories\Admin\CoreData\CountryRepository;

class RejoinController extends Controller
{
    private $rejoinRepository,$countryRepository;

    public function __construct(RejoinRepository $RejoinRepository,CountryRepository $CountryRepository)
    {
        $this->rejoinRepository = $RejoinRepository;
        $this->countryRepository = $CountryRepository;
    }

    public function index()
    {
        $datas = $this->rejoinRepository->getData();
        $country = $this->countryRepository->listData();
        return view(checkView('admin.core_data.rejoin.index'), compact('datas','country'));
    }

    public function store(CreateRequest $request)
    {
        return response()->json($this->rejoinRepository->storeData($request));
    }

    public function update(EditRequest $request, $id)
    {
        return response()->json($this->rejoinRepository->updateData($request, $id));
    }

    public function changeStatus($id)
    {
        $this->rejoinRepository->updateStatusData($id);
    }

    public function destroy($id)
    {
        $this->rejoinRepository->deleteData($id);
    }

    public function remove($id)
    {;
        $this->rejoinRepository->removeData($id);
    }

    public function destroyIndex()
    {
        $datas = $this->rejoinRepository->getDataDelete();
        return view(checkView('admin.core_data.rejoin.destroy'), compact('datas'));
    }

    public function restore($id)
    {
        $this->rejoinRepository->restoreData($id);
    }

    public function listIndex($country,$city)
    {
        return $this->rejoinRepository->listData($country,$city);
    }

    public function show($id)
    {
        return $this->rejoinRepository->showData($id);
    }
}
