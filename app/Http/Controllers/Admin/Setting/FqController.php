<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\FQ\CreateRequest;
use App\Http\Requests\Admin\Setting\FQ\EditRequest;
use App\Repositories\Setting\FQRepository;

class FQController extends Controller
{
    private $fqRepository;

    public function __construct(FQRepository $FQRepository)
    {
        $this->fqRepository = $FQRepository;
        $this->middleware(['permission:fq-list','permission:setting-list'])->except('listIndex');
        $this->middleware('permission:fq-index')->only('index');
        $this->middleware('permission:fq-create')->only('store');
        $this->middleware('permission:fq-edit')->only('show','update');
        $this->middleware('permission:fq-status')->only('changeStatus');
        $this->middleware('permission:fq-delete')->only('destroy');
        $this->middleware('permission:fq-index-delete')->only('destroyIndex');
        $this->middleware('permission:fq-restore')->only('restore');
        $this->middleware('permission:fq-remove')->only('remove');
    }

    public function index()
    {
        $datas = $this->fqRepository->getData();
        return view(checkView('admin.setting.fq.index'), compact('datas'));
    }

    public function store(CreateRequest $request)
    {
        return response()->json($this->fqRepository->storeData($request));
    }

    public function update(EditRequest $request, $id)
    {
        return response()->json($this->fqRepository->updateData($request, $id));
    }

    public function changeStatus($id)
    {
        $this->fqRepository->updateStatusData($id);
    }

    public function destroy($id)
    {
        $this->fqRepository->deleteData($id);
    }

    public function remove($id)
    {
        $this->fqRepository->removeData($id);
    }

    public function destroyIndex()
    {
        $datas = $this->fqRepository->getDataDelete();
        return view(checkView('admin.setting.fq.destroy'), compact('datas'));
    }

    public function restore($id)
    {
        $this->fqRepository->restoreData($id);
    }

    public function listIndex()
    {
        return $this->fqRepository->listData();
    }

    public function show($id)
    {
        return $this->fqRepository->showData($id);
    }
}
