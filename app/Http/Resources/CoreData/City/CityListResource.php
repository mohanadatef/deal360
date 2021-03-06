<?php

namespace App\Http\Resources\CoreData\City;

use App\Http\Resources\CoreData\Country\CountryListResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CityListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title ? $this->title->value : "",
            'country' => new CountryListResource($this->country),
        ];
    }
}
