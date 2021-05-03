<?php

namespace App\Http\Resources\Admin\Amenity;

use Illuminate\Http\Resources\Json\JsonResource;

class AmenityResource extends JsonResource
{
    public function toArray($request)
    {
       return [
            'id' => $this->id,
            'title' => $this->title->value,
            'order' => $this->order,
            'status' => $this->status,
            'image' => image_get($this->image,'amenity'),
        ];
    }
}
