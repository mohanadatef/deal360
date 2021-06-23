<?php

namespace App\Http\Resources\Acl\Role;

use App\Http\Resources\Acl\Permission\PermissionListResource;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title ? $this->title->value : "",
            'code' => $this->code,
            /*'permission' =>PermissionListResource::collection($this->permission),*/
        ];
    }
}
