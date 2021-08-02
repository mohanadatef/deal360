<?php

namespace App\Http\Resources\Acl\Agent;

use App\Http\Resources\Acl\Company\CompanyCardResource;
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
            'email' => $this->user->email,
            'country' => new CountryListResource($this->user->country),
            'image' => getImag($this->user->image,'user'),
            'website'=>$this->user->website,
            'company'=> $this->company ? new CompanyCardResource($this->company) : trans('lang.Alone'),
            'buy_count'=>$this->buy_count ?$this->buy_count:0,
            'rent_count'=>$this->rent_count ?$this->rent_count:0,
            'commercial_count'=>$this->commercial_count ?$this->commercial_count:0,
            'avg_rating'=>round($this->review->avg('rating'),1),
        ];
    }
}
