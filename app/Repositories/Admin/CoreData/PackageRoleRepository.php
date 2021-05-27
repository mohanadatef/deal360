<?php

namespace App\Repositories\Admin\CoreData;


use App\Http\Resources\Admin\Acl\Role\RoleListResource;
use App\Interfaces\Admin\CoreData\PackageRoleInterface;
use App\Models\CoreData\PackageRole;

class PackageRoleRepository implements PackageRoleInterface
{
    protected $data;

    public function __construct(PackageRole $PackageRole)
    {
        $this->data = $PackageRole;
    }

    public function listData($id)
    {
        return RoleListResource::collection($this->data->where('package_id', $id)->get());
    }
}
