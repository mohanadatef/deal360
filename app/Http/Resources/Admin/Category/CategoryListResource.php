<?php

namespace App\Http\Resources\Admin\Category;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryListResource extends JsonResource
{
    public function toArray($request)
    {
       return [
            'id' => $this->id,
            'title' => $this->title->value,
            'image' => image_get($this->image,'category'),
        ];
    }
}
