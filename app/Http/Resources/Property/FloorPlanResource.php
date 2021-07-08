<?php

namespace App\Http\Resources\Property;

use Illuminate\Http\Resources\Json\JsonResource;

class FloorPlanResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'size'=>$this->size?$this->size:0,
            'room'=>$this->room?$this->room:0,
            'bedroom'=>$this->bedroom?$this->bedroom:0,
            'bathroom'=>$this->bathroom?$this->bathroom:0,
            'price'=>$this->price?$this->price:0,
            'image'=>getImag($this->image,'property_plan'),
        ];
    }
}
