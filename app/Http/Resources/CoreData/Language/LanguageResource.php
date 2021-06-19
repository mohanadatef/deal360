<?php

namespace App\Http\Resources\CoreData\Language;

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
            'image' => getImag($this->image,'language'),
        ];
    }
}
