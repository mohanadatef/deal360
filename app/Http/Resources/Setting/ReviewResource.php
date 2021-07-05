<?php

namespace App\Http\Resources\Setting;

use App\Http\Resources\Acl\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title'=>$this->title,
            'description'=>$this->description,
            'rating'=>$this->rating,
            'user'=>new UserResource($this->user),
        ];
    }
}
