<?php

namespace App\Http\Resources\Property\Property;

use App\Http\Resources\Acl\Agent\AgentCardResource;
use App\Http\Resources\Acl\Company\CompanyCardResource;
use App\Http\Resources\Acl\User\UserResource;
use App\Http\Resources\CoreData\Amenity\AmenityListResource;
use App\Http\Resources\CoreData\Category\CategoryResource;
use App\Http\Resources\CoreData\City\CityResource;
use App\Http\Resources\CoreData\Country\CountryResource;
use App\Http\Resources\CoreData\Currency\CurrencyResource;
use App\Http\Resources\CoreData\HighLight\HighLightListResource;
use App\Http\Resources\CoreData\Rejoin\RejoinResource;
use App\Http\Resources\CoreData\Status\StatusResource;
use App\Http\Resources\CoreData\Type\TypeResource;
use App\Http\Resources\Property\FloorPlanResource;
use App\Http\Resources\Setting\ReviewResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class PropertyResource extends JsonResource
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
            $user = new AgentCardResource($this->user->agent);
        } elseif ($role == 4) {
            $user = new CompanyCardResource($this->user->agency);
        } else {
            $user = new UserResource($this->user);
        }
        return [
            'image' => getImag($this->image,'property'),
            'main'=>array(
                'title' => $this->title ? $this->title->value : "",
                'description' => $this->description ? $this->description->value : "",
                'price' => $this->price ? $this->price : 0,
                'status' => new StatusResource($this->status),
                'type' => new TypeResource($this->type),
                'category' => new CategoryResource($this->category),
                'currency' => new CurrencyResource($this->currency),
                'high_light' => new HighLightListResource($this->highlight),
                'country' => new CountryResource($this->country),
                'city' => new CityResource($this->city),
                'rejoin' => new RejoinResource($this->rejoin),
            ),
            'overview'=>array(
                'available_from' => $this->available_from ? $this->available_from : 0,
                'area' => $this->area ? $this->area : 0,
                'garage' => $this->garage ? $this->garage : 0,
                'bathroom' => $this->bathroom ? $this->bathroom : 0,
                'bedroom' => $this->bedroom ? $this->bedroom : 0,
            ),
            'description' => $this->description ? $this->description->value : "",
            'propertyDetails'=>array(
                'id' => $this->id,
                'price' => $this->price ? $this->price : 0,
                'available_from' => $this->available_from ? $this->available_from : 0,
                'bathroom' => $this->bathroom ? $this->bathroom : 0,
                'bedroom' => $this->bedroom ? $this->bedroom : 0,
                'area' => $this->area ? $this->area : 0,
                'size' => $this->size ? $this->size : 0,
                'lot_size' => $this->lot_size ? $this->lot_size : 0,
                'room' => $this->room ? $this->room : 0,
            ),
            'propertyLocation'=>array(
                'latitude' => $this->latitude ? $this->latitude : 0,
                'longitude' => $this->longitude ? $this->longitude : 0,
                'address' => $this->address ? $this->address->value : "",
                'country' => new CountryResource($this->country),
                'city' => new CityResource($this->city),
                'rejoin' => new RejoinResource($this->rejoin),
            ),
            'floor_plans' => FloorPlanResource::collection($this->floor_plan),
            'amenities' => AmenityListResource::collection($this->amenity),
            'reviews' => [
                'count_review' => $this->review->count(),
                'count_review_5' => $this->review->where('rating', 5)->count(),
                'count_review_4' => $this->review->where('rating', 4)->count(),
                'count_review_3' => $this->review->where('rating', 3)->count(),
                'count_review_2' => $this->review->where('rating', 2)->count(),
                'count_review_1' => $this->review->where('rating', 1)->count(),
                'avg_review' => round($this->review->avg('rating'), 1),
                'all_review' => ReviewResource::collection($this->review),
            ],
            'same_properties' => PropertyCardResource::collection($this->same_property),
            'user' => $user,
            'video_url' => $this->video_url ? $this->video_url : "",
            'virtual_tour' => $this->virtual_tour ? $this->virtual_tour : 0,
            'youtube_id' => $this->youtube_id ? $this->youtube_id : 0,
            'floor_number' => $this->floor_number ? $this->floor_number : 0,
            'type_date' => $this->type_date ? $this->type_date : 0,
            'count_date' => $this->count_date ? $this->count_date : 0,
            'order' => $this->order ? $this->order : 0,
            'favourite' => isset($favourite) ? $favourite : 0,
            'count_view' => $this->count_view,
        ];
    }
}
