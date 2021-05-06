<?php

namespace App\Http\Controllers\Admin\CoreData;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CoreData\Status\CreateRequest;
use App\Http\Requests\Admin\CoreData\Status\EditRequest;
use App\Repositories\Admin\CoreData\StatusRepository;

class StatusController extends Controller
{
    private $statusRepository;

    public function __construct(StatusRepository $StatusRepository)
    {
        $this->statusRepository = $StatusRepository;
    }

    public function index()
    {
        $datas = $this->statusRepository->getAllData();
        return view(checkView('admin.core_data.status.index'), compact('datas'));
    }

    public function store(CreateRequest $request)
    {
        return response()->json($this->statusRepository->storeData($request));
    }

    public function update(EditRequest $request, $id)
    {
        return response()->json($this->statusRepository->updateData($request, $id));
    }

    public function changeStatus($id)
    {
        $this->statusRepository->updateStatusData($id);
    }

    public function destroy($id)
    {
        $this->statusRepository->deleteData($id);
    }

    public function remove($id)
    {
        $this->statusRepository->removeData($id);
    }

    public function destroyIndex()
    {
        $datas = $this->statusRepository->getAllDataDelete();
        return view(checkView('admin.core_data.status.destroy'), compact('datas'));
    }

    public function restore($id)
    {
        $this->statusRepository->restoreData($id);
    }

    public function listIndex()
    {
        return $this->statusRepository->listData();
    }

    public function show($id)
    {
        return $this->statusRepository->showData($id);
    }
}
