<?php

namespace App\Http\Resources\CoreData\Language;

use Illuminate\Http\Resources\Json\JsonResource;

class LanguageListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'code' => $this->code,
            'image' => getImag($this->image,'language'),
            ];
    }
}
