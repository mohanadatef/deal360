<?php

namespace App\Http\Resources\Admin\Country;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title ? $this->title->value : "",
            'image' => getImag($this->image,'country'),
        ];
    }
}
