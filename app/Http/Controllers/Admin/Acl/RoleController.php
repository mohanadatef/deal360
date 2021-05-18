<?php

namespace App\Http\Controllers\Admin\Acl;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Acl\Role\CreateRequest;
use App\Http\Requests\Admin\Acl\Role\EditRequest;
use App\Repositories\Admin\Acl\PermissionRepository;
use App\Repositories\Admin\Acl\RolePermissionRepository;
use App\Repositories\Admin\Acl\RoleRepository;

class RoleController extends Controller
{
    private $roleRepository;
    private $permissionRepository;
    private $rolePermissionRepository;

    public function __construct(RoleRepository $RoleRepository,PermissionRepository $PermissionRepository,
                                RolePermissionRepository $RolePermissionRepository)
    {
        $this->roleRepository = $RoleRepository;
        $this->permissionRepository = $PermissionRepository;
        $this->rolePermissionRepository = $RolePermissionRepository;
    }

    public function index()
    {
        $datas = $this->roleRepository->getData();
        return view(checkView('admin.acl.role.index'),compact('datas'));
    }

    public function create()
    {
        $permission = $this->permissionRepository->listData();
        return view(checkView('admin.acl.role.create'),compact('permission'));
    }

    public function store(CreateRequest $request)
    {
        $this->roleRepository->storeData($request);
        return redirect(route('role.index'))->with(trans('Done'));
    }

    public function edit($id)
    {
        $permission = $this->permissionRepository->listData();
        $data = $this->roleRepository->showData($id);
        $role_permission = $this->rolePermissionRepository->listData($id);
        return view(checkView('admin.acl.role.edit'),compact('data','permission','role_permission'));
    }

    public function update(EditRequest $request, $id)
    {
        $this->roleRepository->updateData($request, $id);
        return redirect(route('role.index'))->with(trans('Done'));
    }

    public function changeStatus($id)
    {
        $this->roleRepository->updateStatusData($id);
    }

    public function destroy($id)
    {
        $this->roleRepository->deleteData($id);
    }

    public function remove($id)
    {;
        $this->roleRepository->removeData($id);
    }

    public function destroyIndex()
    {
        $datas = $this->roleRepository->getDataDelete();
        return view(checkView('admin.acl.role.destroy'), compact('datas'));
    }

    public function restore($id)
    {
        $this->roleRepository->restoreData($id);
    }

    public function listIndex()
    {
        return $this->roleRepository->listData();
    }

    /*public function show($id)
    {
        return $this->roleRepository->showData($id);
    }*/
}
