<?php

namespace App\Http\Resources\Admin\Amenity;

use Illuminate\Http\Resources\Json\JsonResource;

class AmenityListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title->value,
            'image' => image_get($this->image,'amenity'),
        ];
    }
}
