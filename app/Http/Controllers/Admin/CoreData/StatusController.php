<?php

namespace App\Http\Controllers\Admin\CoreData;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CoreData\Status\CreateRequest;
use App\Http\Requests\Admin\CoreData\Status\EditRequest;
use App\Repositories\CoreData\StatusRepository;

class StatusController extends Controller
{
    private $statusRepository;

    public function __construct(StatusRepository $StatusRepository)
    {
        $this->statusRepository = $StatusRepository;
        $this->middleware(['permission:status-list','permission:core-data-list'])->except('listIndex');
        $this->middleware('permission:status-index')->only('index');
        $this->middleware('permission:status-create')->only('store');
        $this->middleware('permission:status-edit')->only('show','update');
        $this->middleware('permission:status-status')->only('changeStatus');
        $this->middleware('permission:status-delete')->only('destroy');
        $this->middleware('permission:status-index-delete')->only('destroyIndex');
        $this->middleware('permission:status-restore')->only('restore');
        $this->middleware('permission:status-remove')->only('remove');
    }

    public function index()
    {
        $datas = $this->statusRepository->getData();
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
        $datas = $this->statusRepository->getDataDelete();
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
