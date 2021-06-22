<?php

namespace App\Http\Resources\Acl\Developer;

use App\Http\Resources\Acl\Role\RoleListResource;
use App\Http\Resources\CoreData\Country\CountryListResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DeveloperResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'fullname' => $this->user->fullname,
            'username' => $this->user->username,
            'email' => $this->user->email,
            'phone' => $this->user->phone,
            'gender' => $this->user->gender,
            'dob' => $this->user->dob,
            'role' => new RoleListResource($this->user->role),
            'country' => new CountryListResource($this->user->country),
            'image' => getImag($this->user->image,'user'),
            'about_me'=>$this->about_me?$this->about_me->value:"",
            'address'=>$this->address?$this->address->value:"",
        ];
    }
}
