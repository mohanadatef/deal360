<?php

namespace App\Http\Resources\Setting\Label;

use Illuminate\Http\Resources\Json\JsonResource;

class LabelListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'key' => $this->key,
            'title' => $this->translation_language ? $this->translation_language->value : "",
        ];
    }
}
