<?php

namespace App\Http\Resources\Admin\Area;

use App\Http\Resources\Admin\City\CityListResource;
use App\Http\Resources\Admin\Country\CountryListResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AreaListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title ? $this->title->value : "",
            'country' => new CountryListResource($this->country),
            'city' => new CityListResource($this->city),
        ];
    }
}
