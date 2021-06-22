<?php

namespace App\Http\Resources\Acl\Agent;

use App\Http\Resources\CoreData\Country\CountryListResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AgentCardResource extends JsonResource
{
    public function toArray($request)
    {
        return [
	        'id' => $this->id,
	        'fullname' => $this->user->fullname,
            'phone' => $this->user->phone,
            'country' => new CountryListResource($this->user->country),
            'image' => getImag($this->user->image,'user'),
            'address'=>$this->address->value,
            'website'=>$this->user->website,
        ];
    }
}