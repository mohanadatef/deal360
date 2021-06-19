<?php

namespace App\Http\Resources\CoreData\Package;

use App\Http\Resources\CoreData\Currency\CurrencyListResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title ? $this->title->value : "",
            'price' => $this->price,
            'currency' => new CurrencyListResource($this->currency),
        ];
    }
}
