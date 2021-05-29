<?php

namespace App\Http\Resources\Admin\Setting\FQ;

use Illuminate\Http\Resources\Json\JsonResource;

class FQResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'question' => $this->question ? $this->question->value : "",
            'answer' => $this->question ? $this->answer->value : "",
            'order' => $this->order,
            'status' => $this->status,
        ];
    }
}
