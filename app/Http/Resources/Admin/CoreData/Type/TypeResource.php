<?php

namespace App\Http\Resources\Admin\CoreData\Type;

use Illuminate\Http\Resources\Json\JsonResource;

class TypeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title ? $this->title->value : "",
            'order' => $this->order,
            'status' => $this->status,
            'image' => getImag($this->image,'type'),
        ];
    }
}
