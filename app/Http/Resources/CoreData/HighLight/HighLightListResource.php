<?php

namespace App\Http\Resources\CoreData\HighLight;

use Illuminate\Http\Resources\Json\JsonResource;

class HighLightListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title ? $this->title->value : "",
        ];
    }
}
