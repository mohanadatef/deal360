<?php

namespace App\Repositories\Admin\Acl;

use App\Http\Resources\Admin\Acl\Permission\PermissionListResource;
use App\Interfaces\Admin\Acl\RolePermissionInterface;
use App\Models\Acl\RolePermission;

class RolePermissionRepository implements RolePermissionInterface
{
    protected $data;

    public function __construct(RolePermission $RolePermission)
    {
        $this->data = $RolePermission;
    }

    public function listData($id)
    {
        return PermissionListResource::collection($this->data->where('role_id', $id)->get());
    }
}
