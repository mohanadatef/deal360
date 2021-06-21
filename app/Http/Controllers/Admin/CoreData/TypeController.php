<?php

namespace App\Http\Controllers\Admin\CoreData;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CoreData\Type\CreateRequest;
use App\Http\Requests\Admin\CoreData\Type\EditRequest;
use App\Repositories\CoreData\TypeRepository;

class TypeController extends Controller
{
    private $typeRepository;

    public function __construct(TypeRepository $TypeRepository)
    {
        $this->typeRepository = $TypeRepository;
        $this->middleware(['permission:type-list','permission:core-data-list'])->except('listIndex');
        $this->middleware('permission:type-index')->only('index');
        $this->middleware('permission:type-create')->only('store');
        $this->middleware('permission:type-edit')->only('show','update');
        $this->middleware('permission:type-status')->only('changeStatus');
        $this->middleware('permission:type-delete')->only('destroy');
        $this->middleware('permission:type-index-delete')->only('destroyIndex');
        $this->middleware('permission:type-restore')->only('restore');
        $this->middleware('permission:type-remove')->only('remove');
    }

    public function index()
    {
        $datas = $this->typeRepository->getData();
        return view(checkView('admin.core_data.type.index'), compact('datas'));
    }

    public function store(CreateRequest $request)
    {
        return response()->json($this->typeRepository->storeData($request));
    }

    public function update(EditRequest $request, $id)
    {
        return response()->json($this->typeRepository->updateData($request, $id));
    }

    public function changeStatus($id)
    {
        $this->typeRepository->updateStatusData($id);
    }

    public function destroy($id)
    {
        $this->typeRepository->deleteData($id);
    }

    public function remove($id)
    {;
        $this->typeRepository->removeData($id);
    }

    public function destroyIndex()
    {
        $datas = $this->typeRepository->getDataDelete();
        return view(checkView('admin.core_data.type.destroy'), compact('datas'));
    }

    public function restore($id)
    {
        $this->typeRepository->restoreData($id);
    }

    public function listIndex()
    {
        return $this->typeRepository->listData();
    }

    public function show($id)
    {
        return $this->typeRepository->showData($id);
    }
}
