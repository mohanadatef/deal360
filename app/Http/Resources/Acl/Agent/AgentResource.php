<?php

namespace App\Http\Resources\Acl\Agent;

use App\Http\Resources\Acl\Company\CompanyCardResource;
use App\Http\Resources\Acl\Role\RoleListResource;
use App\Http\Resources\CoreData\Country\CountryListResource;
use App\Http\Resources\Property\Property\PropertyCardResource;
use App\Http\Resources\Setting\ReviewResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AgentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'username' => $this->user->username,
            'email' => $this->user->email,
            'phone' => $this->user->phone,
            'website'=>$this->user->website,
            'gender' => $this->user->gender,
            'dob' => $this->user->dob,
            'approve'=>$this->user->approve,
            'role' => new RoleListResource($this->user->role),
            'about_me'=>$this->about_me?$this->about_me->value:"",
            'address'=>$this->address?$this->address->value:"",
            'company'=> $this->company?new CompanyCardResource($this->company):trans('lang.Alone'),
            'worktime'=>$this->worktime,
            'count_view'=>$this->user->count_view,
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
