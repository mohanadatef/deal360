<?php

namespace App\Http\Resources\Acl\Developer;

use Illuminate\Http\Resources\Json\JsonResource;

class DeveloperListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
	        'id' => $this->id,
	        'user_id' => $this->user_id,
	        'fullname' => $this->fullname,
        ];
    }
}
