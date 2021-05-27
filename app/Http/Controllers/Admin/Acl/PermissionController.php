<?php

namespace App\Http\Controllers\Admin\Acl;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Acl\Permission\CreateRequest;
use App\Http\Requests\Admin\Acl\Permission\EditRequest;
use App\Repositories\Admin\Acl\PermissionRepository;

class PermissionController extends Controller
{
    private $permissionRepository;

    public function __construct(PermissionRepository $PermissionRepository)
    {
        $this->permissionRepository = $PermissionRepository;
        $this->middleware(['permission:permission-list','permission:acl-list'])->except('listIndex');
        $this->middleware('permission:permission-index')->only('index');
        $this->middleware('permission:permission-create')->only('store');
        $this->middleware('permission:permission-edit')->only('show','update');
        $this->middleware('permission:permission-delete')->only('destroy');
        $this->middleware('permission:permission-index-delete')->only('destroyIndex');
        $this->middleware('permission:permission-restore')->only('restore');
        $this->middleware('permission:permission-remove')->only('remove');
    }

    public function index()
    {
        $datas = $this->permissionRepository->getData();
        return view(checkView('admin.acl.permission.index'), compact('datas'));
    }

    public function store(CreateRequest $request)
    {
        return response()->json($this->permissionRepository->storeData($request));
    }

    public function update(EditRequest $request, $id)
    {
        return response()->json($this->permissionRepository->updateData($request, $id));
    }

    public function destroy($id)
    {
        $this->permissionRepository->deleteData($id);
    }

    public function remove($id)
    {;
        $this->permissionRepository->removeData($id);
    }

    public function destroyIndex()
    {
        $datas = $this->permissionRepository->getDataDelete();
        return view(checkView('admin.acl.permission.destroy'), compact('datas'));
    }

    public function restore($id)
    {
        $this->permissionRepository->restoreData($id);
    }

    public function listIndex()
    {
        return $this->permissionRepository->listData();
    }

    public function show($id)
    {
        return $this->permissionRepository->showData($id);
    }
}
