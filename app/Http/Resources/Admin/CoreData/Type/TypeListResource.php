<?php

namespace App\Http\Resources\Admin\CoreData\Type;

use Illuminate\Http\Resources\Json\JsonResource;

class TypeListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title ? $this->title->value : "",
            'image' => getImag($this->image,'type'),
        ];
    }
}
