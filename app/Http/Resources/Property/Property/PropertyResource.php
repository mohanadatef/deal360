<?php

namespace App\Http\Resources\Property\Property;

use App\Http\Resources\Acl\Company\CompanyCardResource;
use App\Http\Resources\Acl\User\UserResource;
use App\Http\Resources\CoreData\Amenity\AmenityListResource;
use App\Http\Resources\CoreData\Category\CategoryResource;
use App\Http\Resources\CoreData\City\CityResource;
use App\Http\Resources\CoreData\Country\CountryResource;
use App\Http\Resources\CoreData\Currency\CurrencyResource;
use App\Http\Resources\CoreData\HighLight\HighLightResource;
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
        $favourite = DB::table('favourites')->where('user_id', $request->user_auth)->where('property_id', $this->id)->count();
        return [
            'id' => $this->id,
            'user' => $this->user->agency ? new CompanyCardResource($this->user->agency) : ($this->user->developer ? new CompanyCardResource($this->user->developer) : new UserResource($this->user)),
            'title' => $this->title ? $this->title->value : "",
            'country' => new CountryResource($this->country),
            'city' => new CityResource($this->city),
            'rejoin' => new RejoinResource($this->rejoin),
            'status' => new StatusResource($this->status),
            'type' => new TypeResource($this->type),
            'category' => new CategoryResource($this->category),
            'currency' => new CurrencyResource($this->currency),
            'high_light' => new HighLightResource($this->high_light),
            'amenity' => AmenityListResource::collection($this->amenity),
            'bathroom' => $this->bathroom ? $this->bathroom : 0,
            'bedroom' => $this->bedroom ? $this->bedroom : 0,
            'area' => $this->area ? $this->area : 0,
            'price' => $this->price ? $this->price : 0,
            'video_url' => $this->video_url ? $this->video_url : "",
            'size' => $this->size ? $this->size : 0,
            'lot_size' => $this->lot_size ? $this->lot_size : 0,
            'room' => $this->room ? $this->room : 0,
            'garage' => $this->garage ? $this->garage : 0,
            'latitude' => $this->latitude ? $this->latitude : 0,
            'longitude' => $this->longitude ? $this->longitude : 0,
            'virtual_tour' => $this->virtual_tour ? $this->virtual_tour : 0,
            'youtube_id' => $this->youtube_id ? $this->youtube_id : 0,
            'available_from' => $this->available_from ? $this->available_from : 0,
            'floor_number' => $this->floor_number ? $this->floor_number : 0,
            'type_date' => $this->type_date ? $this->type_date : 0,
            'count_date' => $this->count_date ? $this->count_date : 0,
            'order' => $this->order ? $this->order : 0,
            'favourite' => $favourite,
            'image' => null,
            'floor_plan' => FloorPlanResource::collection($this->floor_plan),
            'same_property' => PropertyCardResource::collection($this->same_property),
            'review' => [
                'count_review'=>$this->review->count(),
                'count_review_5'=>$this->review->where('rating',5)->count(),
                'count_review_4'=>$this->review->where('rating',4)->count(),
                'count_review_3'=>$this->review->where('rating',3)->count(),
                'count_review_2'=>$this->review->where('rating',2)->count(),
                'count_review_1'=>$this->review->where('rating',1)->count(),
                'avg_review'=>round($this->review->avg('rating'),1),
                'all_review' => ReviewResource::collection($this->review),
                ],
        ];
    }
}
