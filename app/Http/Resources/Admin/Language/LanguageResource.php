<?php

namespace App\Http\Resources\Admin\Language;

use Illuminate\Http\Resources\Json\JsonResource;

class LanguageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'code' => $this->code,
            'order' => $this->order,
            'status' => $this->status,
            'image' => image_get($this->image,'language'),
        ];
    }
}
