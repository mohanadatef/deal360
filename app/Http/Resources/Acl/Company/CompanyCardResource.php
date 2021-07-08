<?php

namespace App\Http\Resources\Acl\Company;

use App\Http\Resources\Acl\Agent\AgentCardResource;
use App\Http\Resources\CoreData\Country\CountryListResource;
use App\Traits\ServiceDataTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyCardResource extends JsonResource
{
    use ServiceDataTrait;
    public function toArray($request)
    {

        return [
            'id' => $this->developer ? $this->developer->id : ($this->agency?$this->agency->id:$this->id),
	        'fullname' => $this->fullname,
            'phone' => $this->phone,
            'role_id' => $this->role_id,
            'country' => new CountryListResource($this->country),
            'image' => getImag($this->image,'user'),
            'address'=>$this->developer ? ($this->developer->address?$this->developer->address->value:""): ($this->agency?($this->agency->address?$this->agency->address->value:($this->address?$this->address->value:"")):""),
            'website'=>$this->website,
            'count_agent'=>$this->developer?$this->developer->agent->count():($this->agency?$this->agency->agent->count():$this->agent->count()),
            'agent'=>AgentCardResource::collection($this->developer?$this->developer->agent:($this->agency?$this->agency->agent:$this->agent)),
            'buy_count'=>$this->buy_count ?$this->buy_count:0,
            'rent_count'=>$this->rent_count ?$this->rent_count:0,
            'commercial_count'=>$this->commercial_count ?$this->commercial_count:0,
            'count_property'=>$this->getPropertyCompany($this)->count(),
            'avg_rating'=>round($this->developer ? $this->developer->review->avg('rating'): ($this->agency?$this->agency->review->avg('rating'):$this->review->avg('rating')),1),
        ];
    }
}
