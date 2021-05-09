<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\Meta\CreateRequest;
use App\Http\Requests\Admin\Setting\Meta\EditRequest;
use App\Repositories\Admin\Setting\MetaRepository;

class MetaController extends Controller
{
    private $metaRepository;

    public function __construct(MetaRepository $MetaRepository)
    {
        $this->metaRepository = $MetaRepository;
    }

    public function index()
    {
        $datas = $this->metaRepository->getData();
        return view(checkView('admin.setting.meta.index'), compact('datas'));
    }

    public function store(CreateRequest $request)
    {
        return response()->json($this->metaRepository->storeData($request));
    }

    public function update(EditRequest $request, $id)
    {
        return response()->json($this->metaRepository->updateData($request, $id));
    }

    public function changeStatus($id)
    {
        $this->metaRepository->updateStatusData($id);
    }

    public function destroy($id)
    {
        $this->metaRepository->deleteData($id);
    }

    public function remove($id)
    {
        $this->metaRepository->removeData($id);
    }

    public function destroyIndex()
    {
        $datas = $this->metaRepository->getDataDelete();
        return view(checkView('admin.setting.meta.destroy'), compact('datas'));
    }

    public function restore($id)
    {
        $this->metaRepository->restoreData($id);
    }

    public function listIndex()
    {
        return $this->metaRepository->listData();
    }

    public function show($id)
    {
        return $this->metaRepository->showData($id);
    }
}
