<?php

namespace App\Http\Controllers\Admin\CoreData;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CoreData\Amenity\CreateRequest;
use App\Http\Requests\Admin\CoreData\Amenity\EditRequest;
use App\Repositories\CoreData\AmenityRepository;

class AmenityController extends Controller
{
    private $amenityRepository;

    public function __construct(AmenityRepository $AmenityRepository)
    {
        $this->amenityRepository = $AmenityRepository;
        $this->middleware(['permission:amenity-list','permission:core-data-list'])->except('listIndex');
        $this->middleware('permission:amenity-index')->only('index');
        $this->middleware('permission:amenity-create')->only('store');
        $this->middleware('permission:amenity-edit')->only('show','update');
        $this->middleware('permission:amenity-status')->only('changeStatus');
        $this->middleware('permission:amenity-delete')->only('destroy');
        $this->middleware('permission:amenity-index-delete')->only('destroyIndex');
        $this->middleware('permission:amenity-restore')->only('restore');
        $this->middleware('permission:amenity-remove')->only('remove');
    }

    public function index()
    {
        $datas = $this->amenityRepository->getData();
        return view(checkView('admin.core_data.amenity.index'), compact('datas'));
    }

    public function store(CreateRequest $request)
    {
        return response()->json($this->amenityRepository->storeData($request));
    }

    public function update(EditRequest $request, $id)
    {
        return response()->json($this->amenityRepository->updateData($request, $id));
    }

    public function changeStatus($id)
    {
        $this->amenityRepository->updateStatusData($id);
    }

    public function destroy($id)
    {
        $this->amenityRepository->deleteData($id);
    }

    public function remove($id)
    {
        $this->amenityRepository->removeData($id);
    }

    public function destroyIndex()
    {
        $datas = $this->amenityRepository->getDataDelete();
        return view(checkView('admin.core_data.amenity.destroy'), compact('datas'));
    }

    public function restore($id)
    {
        $this->amenityRepository->restoreData($id);
    }

    public function listIndex()
    {
        return $this->amenityRepository->listData();
    }

    public function show($id)
    {
        return $this->amenityRepository->showData($id);
    }
}
