<?php

namespace App\Http\Resources\Acl\User;

use App\Http\Resources\Acl\Role\RoleListResource;
use App\Http\Resources\CoreData\Country\CountryListResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'fullname' => $this->fullname,
            'username' => $this->username,
            'email' => $this->email,
            'token' => $this->token,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'dob' => $this->dob,
            'approve'=>$this->approve,
            'role' => new RoleListResource($this->role),
            'country' => new CountryListResource($this->country),
            'image' => getImag($this->image,'user'),
        ];
    }
}
