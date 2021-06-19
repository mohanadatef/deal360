<?php

namespace App\Http\Resources\Acl\Agency;

use Illuminate\Http\Resources\Json\JsonResource;

class AgencyListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
	        'id' => $this->id,
	        'user_id' => $this->user_id,
	        'fullname' => $this->user->fullname,
        ];
    }
}
