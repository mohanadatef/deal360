<?php

namespace App\Http\Resources\Acl\Company;
use App\Http\Resources\Property\Property\PropertyCardResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyPropertyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'buy_count'=>$this->buy_count ?$this->buy_count:0,
            'rent_count'=>$this->rent_count ?$this->rent_count:0,
            'commercial_count'=>$this->commercial_count ?$this->commercial_count:0,
            'count_properties'=>$this->property->count(),
            'properties'=> PropertyCardResource::collection($this->property),
            'count_view'=>$this->user->count_view,
        ];
    }
}
