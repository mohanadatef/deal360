<?php

namespace App\Repositories\Admin\Acl;


use App\Http\Requests\Admin\Acl\Role\CreateRequest;
use App\Http\Requests\Admin\Acl\Role\EditRequest;
use App\Interfaces\Admin\Acl\RoleInterface;
use App\Models\ACL\RolePermission;
use App\Models\Acl\Role;
use App\Traits\Service;
use Illuminate\Support\Facades\Auth;

class RoleRepository implements RoleInterface
{
    use Service;
    protected $role;
    protected $permission_role;

    public function __construct(Role $role, RolePermission $permission_role)
    {
        $this->role = $role;
        $this->permission_role = $permission_role;
    }

    public function Get_All_Data()
    {
        return $this->role->order('asc')->all();
    }

    public function Create_Data(CreateRequest $request)
    {
        $this->role->create($request->all());
    }

    public function Get_One_Data($id)
    {
        return $this->role->findorFail($id);
    }

    public function Update_Data(EditRequest $request, $id)
    {
        $role = $this->Get_One_Data($id);
        $role->permission()->sync((array)$request->permission);
        $role->update($request->all());
    }

    public function Get_List_Data()
    {
        return $this->role->select('title', 'id')->status(1)->get();
    }

    public function Get_Permission_For_Role($id)
    {
        return $this->permission_role->where('role_id', $id)->get();
    }

    public function Get_List_Register()
    {
        return  $this->role->select('title', 'id')->status(1)->get();
    }
}
