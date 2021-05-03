<?php

namespace App\Http\Resources\Admin\Area;

use App\Http\Resources\Admin\City\CityListResource;
use App\Http\Resources\Admin\Country\CountryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AreaResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title->value,
            'order' => $this->order,
            'status' => $this->status,
            'country' => new CountryResource($this->country),
            'city' => new CityListResource($this->city),
        ];
    }
}
