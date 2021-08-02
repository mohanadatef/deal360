<?php

namespace App\Http\Resources\Property\Property;

use App\Http\Resources\Acl\Agent\AgentCardResource;
use App\Http\Resources\Acl\Company\CompanyCardResource;
use App\Http\Resources\Acl\User\UserResource;
use App\Http\Resources\CoreData\Category\CategoryListResource;
use App\Http\Resources\CoreData\City\CityResource;
use App\Http\Resources\CoreData\Country\CountryResource;
use App\Http\Resources\CoreData\Currency\CurrencyResource;
use App\Http\Resources\CoreData\HighLight\HighLightListResource;
use App\Http\Resources\CoreData\Type\TypeListResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class PropertyCardResource extends JsonResource
{
    public function toArray($request)
    {
        if (isset($request->auth_id) && !empty($request->auth_id)) {
            $favourite = DB::table('favourites')->where('user_id', $request->auth_id)->where('property_id', $this->id)->count();
        }
        $role = $this->user->role_id;
        if ($role == 6) {
            $user = new CompanyCardResource($this->user->developer);
        } elseif ($role == 5) {
            $user = new AgentCardResource($this->user->developer);
        } elseif ($role == 4) {
            $user = new CompanyCardResource($this->user->agent);
        } else {
            $user = new UserResource($this->user);
        }
        return [
            'id' => $this->id,
            'user' => $user,
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
            'high_light' => new HighLightListResource($this->highlight),
            'favourite'=>isset($favourite)?$favourite:0,
            'images'=>getImag($this->image,'property'),
        ];
    }
}
