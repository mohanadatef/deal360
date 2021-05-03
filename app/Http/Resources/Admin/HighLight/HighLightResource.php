<?php

namespace App\Http\Resources\Admin\HighLight;

use Illuminate\Http\Resources\Json\JsonResource;

class HighLightResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title->value,
            'order' => $this->order,
            'status' => $this->status,
        ];
    }
}
