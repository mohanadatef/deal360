<?php

namespace App\Http\Resources\Acl\Agent;

use App\Http\Resources\Acl\Company\CompanyCardResource;
use App\Http\Resources\Acl\Role\RoleListResource;
use App\Http\Resources\CoreData\Country\CountryListResource;
use App\Http\Resources\Property\Property\PropertyCardResource;
use App\Http\Resources\Setting\ReviewResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AgentPropertyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'buy_count'=>$this->buy_count ?$this->buy_count:0,
            'rent_count'=>$this->rent_count ?$this->rent_count:0,
            'commercial_count'=>$this->commercial_count ?$this->commercial_count:0,
            'properties'=> PropertyCardResource::collection($this->property),
        ];
    }
}
