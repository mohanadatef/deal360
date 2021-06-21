<?php

namespace App\Http\Controllers\Admin\CoreData;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CoreData\HighLight\CreateRequest;
use App\Http\Requests\Admin\CoreData\HighLight\EditRequest;
use App\Repositories\CoreData\HighLightRepository;

class HighLightController extends Controller
{
    private $highlightRepository;

    public function __construct(HighLightRepository $HighLightRepository)
    {
        $this->highlightRepository = $HighLightRepository;
        $this->middleware(['permission:highlight-list','permission:core-data-list'])->except('listIndex');
        $this->middleware('permission:highlight-index')->only('index');
        $this->middleware('permission:highlight-create')->only('store');
        $this->middleware('permission:highlight-edit')->only('show','update');
        $this->middleware('permission:highlight-status')->only('changeStatus');
        $this->middleware('permission:highlight-delete')->only('destroy');
        $this->middleware('permission:highlight-index-delete')->only('destroyIndex');
        $this->middleware('permission:highlight-restore')->only('restore');
        $this->middleware('permission:highlight-remove')->only('remove');
    }

    public function index()
    {
        $datas = $this->highlightRepository->getData();
        return view(checkView('admin.core_data.highlight.index'), compact('datas'));
    }

    public function store(CreateRequest $request)
    {
        return response()->json($this->highlightRepository->storeData($request));
    }

    public function update(EditRequest $request, $id)
    {
        return response()->json($this->highlightRepository->updateData($request, $id));
    }

    public function changeStatus($id)
    {
        $this->highlightRepository->updateStatusData($id);
    }

    public function destroy($id)
    {
        $this->highlightRepository->deleteData($id);
    }

    public function remove($id)
    {
        $this->highlightRepository->removeData($id);
    }

    public function destroyIndex()
    {
        $datas = $this->highlightRepository->getDataDelete();
        return view(checkView('admin.core_data.highlight.destroy'), compact('datas'));
    }

    public function restore($id)
    {
        $this->highlightRepository->restoreData($id);
    }

    public function listIndex()
    {
        return $this->highlightRepository->listData();
    }

    public function show($id)
    {
        return $this->highlightRepository->showData($id);
    }
}
