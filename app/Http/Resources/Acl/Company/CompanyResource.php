<?php

namespace App\Http\Resources\Acl\Company;

use App\Http\Resources\Acl\Agent\AgentCardResource;
use App\Http\Resources\CoreData\Country\CountryListResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
	        'fullname' => $this->user->fullname,
            'phone' => $this->user->phone,
            'country' => new CountryListResource($this->user->country),
            'image' => getImag($this->user->image,'user'),
            'address'=>$this->address?$this->address->value:"",
            'website'=>$this->user->website,
            'agent'=>AgentCardResource::collection($this->agent),
        ];
    }
}