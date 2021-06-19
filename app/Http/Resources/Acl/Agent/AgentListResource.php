<?php

namespace App\Http\Resources\Acl\Agent;

use Illuminate\Http\Resources\Json\JsonResource;

class AgentListResource extends JsonResource
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
