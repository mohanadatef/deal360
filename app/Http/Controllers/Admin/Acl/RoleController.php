<?php

namespace App\Http\Controllers\Admin\Acl;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Acl\Role\CreateRequest;
use App\Http\Requests\Admin\Acl\Role\EditRequest;
use App\Repositories\Admin\Acl\PermissionRepository;
use App\Repositories\Admin\Acl\RoleRepository;

class RoleController extends Controller
{
    private $roleRepository;
    private $permissionRepository;

    public function __construct(RoleRepository $RoleRepository,PermissionRepository $PermissionRepository)
    {
        $this->roleRepository = $RoleRepository;
        $this->permissionRepository = $PermissionRepository;
    }

    public function index()
    {
        $datas = $this->roleRepository->getData();
        return view('admin.acl.role.index',compact('datas'));
    }

    public function create()
    {
        $permission = $this->permissionRepository->Get_listData();
        return view('admin.acl.role.create',compact('permission'));
    }

    public function store(CreateRequest $request)
    {
        $this->roleRepository->storeData($request);

        return redirect('role.index')->with('message', trans('lang.Message_Store'));
    }

    public function edit($id)
    {
        $permission = $this->permissionRepository->Get_listData();
        $data = $this->roleRepository->Get_One_Data($id);
        $permission_role = $this->roleRepository->Get_Permission_For_Role($data['id']);
        return view('admin.acl.role.edit',compact('data','permission','permission_role'));
    }

    public function update(EditRequest $request, $id)
    {
        $this->roleRepository->updateData($request, $id);
        return redirect('role.index')->with('message', trans('lang.Message_Edit'));
    }
}
