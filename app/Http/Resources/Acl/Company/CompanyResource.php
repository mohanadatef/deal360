<?php

namespace App\Http\Resources\Acl\Company;

use App\Http\Resources\Acl\Agent\AgentCardResource;
use App\Http\Resources\Acl\Role\RoleListResource;
use App\Http\Resources\CoreData\Country\CountryListResource;
use App\Http\Resources\Property\Property\PropertyCardResource;
use App\Http\Resources\Setting\ReviewResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
	        'fullname' => $this->user->fullname,
            'phone' => $this->user->phone,
            'role' => new RoleListResource($this->user->role),
            'country' => new CountryListResource($this->user->country),
            'image' => getImag($this->user->image,'user'),
            'address'=>$this->address?$this->address->value:"",
            'about_me'=>$this->about_me?$this->about_me->value:"",
            'website'=>$this->user->website,
            'count_agent'=>$this->agent->count(),
            'agent'=>AgentCardResource::collection($this->agent),
            'buy_count'=>$this->buy_count ?$this->buy_count:0,
            'rent_count'=>$this->rent_count ?$this->rent_count:0,
            'commercial_count'=>$this->commercial_count ?$this->commercial_count:0,
            'count_property'=>$this->property->count(),
            'property'=> PropertyCardResource::collection($this->property),
            'review' => [
                'count_review'=>$this->review->count(),
                'count_review_5'=>$this->review->where('rating',5)->count(),
                'count_review_4'=>$this->review->where('rating',4)->count(),
                'count_review_3'=>$this->review->where('rating',3)->count(),
                'count_review_2'=>$this->review->where('rating',2)->count(),
                'count_review_1'=>$this->review->where('rating',1)->count(),
                'avg_review'=>round($this->review->avg('rating'),1),
                'all_review' => ReviewResource::collection($this->review),
            ],
            ];
    }
}
