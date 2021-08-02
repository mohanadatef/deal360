<?php

namespace App\Http\Resources\Setting\Advertising;

use Illuminate\Http\Resources\Json\JsonResource;

class AdvertisingResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'url' => $this->url,
            'image' => getImag($this->image,'advertising'),
        ];
    }
}
