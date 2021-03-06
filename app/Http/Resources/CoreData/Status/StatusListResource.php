<?php

namespace App\Http\Resources\CoreData\Status;

use Illuminate\Http\Resources\Json\JsonResource;

class StatusListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title ? $this->title->value : "",
        ];
    }
}
