<?php

namespace App\Http\Resources\Acl\Company;

use App\Http\Resources\Acl\Agent\AgentCardResource;
use App\Http\Resources\CoreData\Country\CountryListResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyCardResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->developer ? $this->developer->id : $this->agency->id,
	        'fullname' => $this->fullname,
            'phone' => $this->phone,
            'role_id' => $this->role_id,
            'country' => new CountryListResource($this->country),
            'image' => getImag($this->image,'user'),
            'address'=>$this->developer ? ($this->developer->address?$this->developer->address->value:""): ($this->agency->address?$this->agency->address->value:""),
            'website'=>$this->website,
            'agent'=>AgentCardResource::collection($this->developer?$this->developer->agent:$this->agency->agent),
            'buy_count'=>$this->buy_count ?$this->buy_count:0,
            'rent_count'=>$this->rent_count ?$this->rent_count:0,
            'commercial_count'=>$this->commercial_count ?$this->commercial_count:0,
        ];
    }
}
