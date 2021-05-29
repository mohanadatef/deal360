<?php

namespace App\Http\Resources\Admin\CoreData\Package;

use App\Http\Resources\Admin\CoreData\Currency\CurrencyListResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title ? $this->title->value : "",
            'count_listing' => $this->count_listing,
            'type_date' => $this->type_date,
            'count_date' => $this->count_date,
            'image_included' => $this->image_included,
            'count_featured' => $this->count_featured,
            'price' => $this->price,
            'order' => $this->order,
            'status' => $this->status,
            'currency' => new CurrencyListResource($this->currency),
        ];
    }
}
