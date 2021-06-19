<?php

namespace App\Http\Resources\Acl\Company;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
	        'id' => $this->company_id ? $this->company_id : $this->company_id1,
	        'user_id' => $this->id,
	        'fullname' => $this->fullname,
        ];
    }
}
