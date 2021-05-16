<?php

namespace App\Http\Resources\Admin\Acl\Permission;

use Illuminate\Http\Resources\Json\JsonResource;

class PermissionListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title ? $this->title->value : "",
        ];
    }
}
