<?php

namespace App\Http\Resources\CoreData\Rejoin;

use App\Http\Resources\CoreData\City\CityListResource;
use App\Http\Resources\CoreData\Country\CountryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class RejoinResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title ? $this->title->value : "",
            'order' => $this->order,
            'status' => $this->status,
            'country' => new CountryResource($this->country),
            'city' => new CityListResource($this->city),
        ];
    }
}
