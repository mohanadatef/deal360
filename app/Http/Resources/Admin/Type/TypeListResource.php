<?php

namespace App\Http\Resources\Admin\Type;

use Illuminate\Http\Resources\Json\JsonResource;

class TypeListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title->value,
            'image' => image_get($this->image,'type'),
        ];
    }
}
