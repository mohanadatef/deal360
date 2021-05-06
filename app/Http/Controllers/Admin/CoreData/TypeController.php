<?php

namespace App\Http\Controllers\Admin\CoreData;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CoreData\Type\CreateRequest;
use App\Http\Requests\Admin\CoreData\Type\EditRequest;
use App\Repositories\Admin\CoreData\TypeRepository;

class TypeController extends Controller
{
    private $typeRepository;

    public function __construct(TypeRepository $TypeRepository)
    {
        $this->typeRepository = $TypeRepository;
    }

    public function index()
    {
        $datas = $this->typeRepository->getAllData();
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
        $datas = $this->typeRepository->getAllDataDelete();
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
