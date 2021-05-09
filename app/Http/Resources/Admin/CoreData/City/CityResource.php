<?php

namespace App\Http\Resources\Admin\CoreData\City;

use App\Http\Resources\Admin\CoreData\Country\CountryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title ? $this->title->value : "",
            'order' => $this->order,
            'status' => $this->status,
            'country' => new CountryResource($this->country),
        ];
    }
}
