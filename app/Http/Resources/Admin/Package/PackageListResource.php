<?php

namespace App\Http\Resources\Admin\Package;

use Illuminate\Http\Resources\Json\JsonResource;

class PackageListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title->value,
        ];
    }
}
