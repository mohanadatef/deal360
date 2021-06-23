<?php

namespace App\Http\Resources\Property\Property;

use App\Http\Resources\Acl\Company\CompanyResource;
use App\Http\Resources\Acl\User\UserResource;
use App\Http\Resources\CoreData\City\CityResource;
use App\Http\Resources\CoreData\Country\CountryResource;
use App\Http\Resources\CoreData\Currency\CurrencyResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyCardResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => $this->user->agency ? new CompanyResource($this->user->agency) : ($this->user->developer ? new CompanyResource($this->user->developer) : new UserResource($this->user)),
            'title' => $this->title ? $this->title->value : "",
            'country'=>new CountryResource($this->country),
            'city'=>new CityResource($this->city),
            'bathroom'=>$this->bathroom?$this->bathroom:0,
            'bedroom'=>$this->bedroom?$this->bedroom:0,
            'area'=>$this->area?$this->area:0,
            'price'=>$this->price?$this->price:0,
            'currency'=>new CurrencyResource($this->currency),
            'image'=>null,
        ];
    }
}
