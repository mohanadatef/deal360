<?php

namespace App\Http\Resources\Acl\Company;

use App\Http\Resources\CoreData\Country\CountryListResource;
use App\Traits\ServiceDataTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyCardResource extends JsonResource
{
    use ServiceDataTrait;

    public function toArray($request)
    {
        return [
            'id' => $this->developer ? $this->developer->id : ($this->agency ? $this->agency->id : $this->id),
            'fullname' => $this->fullname?$this->fullname:$this->user->fullname,
            'phone' => $this->phone?$this->phone:$this->user->phone,
            'role_id' => $this->role_id?$this->role_id:$this->user->role_id,
            'country' => new CountryListResource($this->country?$this->country:$this->user->country),
            'image' => getImag($this->image, 'user'),
            'website' => $this->website,
            'count_agents' => $this->developer ? $this->developer->agent->count() : ($this->agency ? $this->agency->agent->count() : ($this->agent?$this->agent->count():$this->user->agent->count())),
            'buy_count' => $this->buy_count ? $this->buy_count : 0,
            'rent_count' => $this->rent_count ? $this->rent_count : 0,
            'commercial_count' => $this->commercial_count ? $this->commercial_count : 0,
            'count_properties' => $this->getPropertyCompany($this)->count(),
            'avg_rating' => round($this->developer ? $this->developer->review->avg('rating') : ($this->agency ? $this->agency->review->avg('rating') : $this->review->avg('rating')), 1),
            'status_work' => 'open',
        ];
    }
}
