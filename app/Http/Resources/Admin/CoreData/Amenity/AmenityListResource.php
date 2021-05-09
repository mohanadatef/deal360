<?php

namespace App\Http\Resources\Admin\CoreData\Amenity;

use Illuminate\Http\Resources\Json\JsonResource;

class AmenityListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title ? $this->title->value : "",
            'image' => getImag($this->image,'amenity'),
        ];
    }
}
