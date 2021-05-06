<?php

namespace App\Http\Controllers\Admin\CoreData;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CoreData\HighLight\CreateRequest;
use App\Http\Requests\Admin\CoreData\HighLight\EditRequest;
use App\Repositories\Admin\CoreData\HighLightRepository;

class HighLightController extends Controller
{
    private $highlightRepository;

    public function __construct(HighLightRepository $HighLightRepository)
    {
        $this->highlightRepository = $HighLightRepository;
    }

    public function index()
    {
        $datas = $this->highlightRepository->getAllData();
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
        $datas = $this->highlightRepository->getAllDataDelete();
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
