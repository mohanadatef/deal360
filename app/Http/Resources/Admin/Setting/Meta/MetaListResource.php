<?php

namespace App\Http\Resources\Admin\Setting\Meta;

use Illuminate\Http\Resources\Json\JsonResource;

class MetaListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title ? $this->title->value : "",
        ];
    }
}
