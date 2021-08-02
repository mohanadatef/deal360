<?php

namespace App\Http\Resources\Acl\Role;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title ? $this->title->value : "",
            'code' => $this->code,
            'type_access' => $this->type_access,
            'order' => $this->order,
            'status' => $this->status,
        ];
    }
}
