<?php

namespace App\Http\Resources\Property\Property;

use App\Http\Resources\Acl\Company\CompanyCardResource;
use App\Http\Resources\Acl\User\UserResource;
use App\Http\Resources\CoreData\Category\CategoryListResource;
use App\Http\Resources\CoreData\City\CityResource;
use App\Http\Resources\CoreData\Country\CountryResource;
use App\Http\Resources\CoreData\Currency\CurrencyResource;
use App\Http\Resources\CoreData\Type\TypeListResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class PropertyCardResource extends JsonResource
{
    public function toArray($request)
    {
        $favourite = DB::table('favourites')->where('user_id',$request->user_auth)->where('property_id',$this->id)->count();
        return [
            'id' => $this->id,
            'user' => $this->user->agency ? new CompanyCardResource($this->user->agency) : ($this->user->developer ? new CompanyCardResource($this->user->developer) : new UserResource($this->user)),
            'title' => $this->title ? $this->title->value : "",
            'country'=>new CountryResource($this->country),
            'city'=>new CityResource($this->city),
            'bathroom'=>$this->bathroom?$this->bathroom:0,
            'bedroom'=>$this->bedroom?$this->bedroom:0,
            'area'=>$this->area?$this->area:0,
            'price'=>$this->price?$this->price:0,
            'currency'=>new CurrencyResource($this->currency),
            'type'=>new TypeListResource($this->type),
            'category'=>new CategoryListResource($this->category),
            'favourite'=>$favourite,
            'image'=>null,
        ];
    }
}
