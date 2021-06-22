<?php

namespace App\Http\Resources\Acl\Company;

use App\Http\Resources\CoreData\Country\CountryListResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyCardResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->company_id ? $this->company_id : $this->company_id1,
	        'fullname' => $this->fullname,
            'phone' => $this->phone,
            'country' => new CountryListResource($this->country),
            'image' => getImag($this->image,'user'),
            'address'=>$this->address?$this->address->value:"",
            'website'=>$this->website,
        ];
    }
}
