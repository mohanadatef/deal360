<?php

namespace App\Http\Resources\Admin\Country;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title->value,
            'image' => image_get($this->image,'country'),
        ];
    }
}
