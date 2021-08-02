<?php

namespace App\Http\Resources\Acl\Company;

use App\Http\Resources\Acl\Agent\AgentCardResource;
use App\Http\Resources\Acl\Role\RoleListResource;
use App\Http\Resources\CoreData\Country\CountryListResource;
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
            'count_agents'=>$this->agent->count(),
            'agents'=>AgentCardResource::collection($this->agent),
            'reviews' => [
                'count_review'=>$this->review->count(),
                'count_review_5'=>$this->review->where('rating',5)->count(),
                'count_review_4'=>$this->review->where('rating',4)->count(),
                'count_review_3'=>$this->review->where('rating',3)->count(),
                'count_review_2'=>$this->review->where('rating',2)->count(),
                'count_review_1'=>$this->review->where('rating',1)->count(),
                'avg_review'=>round($this->review->avg('rating'),1),
                'all_review' => ReviewResource::collection($this->review),
            ],
            'profile_card'=>[
                'image' => getImag($this->user->image,'user'),
                'country' => new CountryListResource($this->user->country),
                'avg_review'=>round($this->review->avg('rating'),1),
                'fullname' => $this->user->fullname,
            ],
            'contact_card'=>[
                'email' => $this->user->email,
                'phone' => $this->user->phone,
                'website'=>$this->user->website,
            ]
        ];
    }
}
