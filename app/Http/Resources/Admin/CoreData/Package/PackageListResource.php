<?php

namespace App\Http\Resources\Admin\CoreData\Package;

use Illuminate\Http\Resources\Json\JsonResource;

class PackageListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title ? $this->title->value : "",
        ];
    }
}
