<?php

namespace App\Repositories\Property;

use App\Interfaces\Property\PropertyInterface;
use App\Models\CoreData\Amenity;
use App\Models\CoreData\City;
use App\Models\CoreData\Country;
use App\Models\CoreData\HighLight;
use App\Models\CoreData\Rejoin;
use App\Models\CoreData\Type;
use App\Models\Property\Property;
use Illuminate\Support\Facades\DB;

class PropertyRepository implements PropertyInterface
{
    protected $data;

    public function __construct(Property $Property)
    {
        $this->data = $Property;
    }

    public function getData($request)
    {
        return cache()->remember('property_get_all', 60 * 60 * 60, function () use($request){
            $data = $this->data->with('user.role', 'city', 'country', 'currency', 'title', 'image', 'category', 'type');
            if (isset($request->web)) {
                if (isset($request->filter_rating)) {
                    if ($request->filter_rating == 1) {
                        $data = $data->orderby('properties.avg_rating', 'asc');
                    } elseif ($request->filter_rating == 0) {
                        $data = $data->orderby('properties.avg_rating', 'desc');
                    }
                }
                if (isset($request->filter_new)) {
                    if ($request->filter_new == 1) {
                        $data = $data->orderBy('properties.created_at', 'asc');
                    } elseif ($request->filter_new == 0) {
                        $data = $data->orderBy('properties.created_at', 'desc');
                    }
                }
            }
            if (isset($request->status_id) && !empty($request->status_id)) {
                $data = $data->statusId($request->status_id);
            } elseif (isset($request->status_name) && !empty($request->status_name)) {
                $data = $data->statusName($request->status_name);
            } elseif (isset($request->web)) {
                $data = $data->statusName('publish');
            }
            if (isset($request->country_id) && !empty($request->country_id)) {
                $data = $data->where('country_id', $request->country_id);
            } elseif (isset($request->country_name) && !empty($request->country_name)) {
                $data = $data->join('translations', 'properties.country_id', 'translations.category_id')
                    ->where('translations.category_type', Country::class)->where('translations.key', 'title')
                    ->where('translations.value', $request->country_name);
            }
            if (isset($request->type_id) && !empty($request->type_id)) {
                $data = $data->where('type_id', $request->type_id);
            } elseif (isset($request->type_name) && !empty($request->type_name)) {
                $data = $data->join('translations', 'properties.type_id', 'translations.category_id')
                    ->where('translations.category_type', Type::class)->where('translations.key', 'title')
                    ->where('translations.value', $request->type_name);
            }
            if (isset($request->city_id) && !empty($request->city_id)) {
                $data = $data->where('city_id', $request->city_id);
            } elseif (isset($request->city_name) && !empty($request->city_name)) {
                $data = $data->join('translations', 'properties.city_id', 'translations.category_id')
                    ->where('translations.category_type', City::class)->where('translations.key', 'title')
                    ->where('translations.value', $request->city_name);
            }
            if (isset($request->rejoin_id) && !empty($request->rejoin_id)) {
                $data = $data->where('rejoin_id', $request->rejoin_id);
            } elseif (isset($request->rejoin_name) && !empty($request->rejoin_name)) {
                $data = $data->join('translations', 'properties.rejoin_id', 'translations.category_id')
                    ->where('translations.category_type', Rejoin::class)->where('translations.key', 'title')
                    ->where('translations.value', $request->rejoin_name);
            }
            if (isset($request->high_light_id) && !empty($request->high_light_id)) {
                $data = $data->where('high_light_id', $request->high_light_id);
            } elseif (isset($request->high_light_name) && !empty($request->high_light_name)) {
                $data = $data->join('translations', 'properties.high_light_id', 'translations.category_id')
                    ->where('translations.category_type', HighLight::class)->where('translations.key', 'title')
                    ->where('translations.value', $request->high_light_name);
            }
            if (isset($request->min_price) && isset($request->max_price) && !empty($request->min_price) && !empty($request->max_price)) {
                if ($request->min_price < $request->max_price) {
                    $data = $data->whereBetween('price', [$request->min_price, $request->max_price]);
                }
            }
            if (isset($request->min_bedroom) && isset($request->max_bedroom) && !empty($request->min_bedroom) && !empty($request->max_bedroom)) {
                if ($request->min_bedroom < $request->max_bedroom) {
                    $data = $data->whereBetween('bedroom', [$request->min_bedroom, $request->max_bedroom]);
                }
            }
            if (isset($request->min_area) && isset($request->max_area) && !empty($request->min_area) && !empty($request->max_area)) {
                if ($request->min_area < $request->max_area) {
                    $data = $data->whereBetween('area', [$request->min_area, $request->max_area]);
                }
            }
            if (isset($request->min_bathroom) && isset($request->max_bathroom) && !empty($request->min_bathroom) && !empty($request->max_bathroom)) {
                if ($request->min_bathroom < $request->max_bathroom) {
                    $data = $data->whereBetween('bathroom', [$request->min_bathroom, $request->max_bathroom]);
                }
            }
            if (isset($request->amenity_id) && !empty($request->amenity_id)) {
                $data = $data->join('property_amenities', 'properties.id', 'property_amenities.property_id')
                    ->wherein('amenity_id', $request->amenity_id);
            } elseif (isset($request->amenity_name) && !empty($request->amenity_name)) {
                $tanslation = DB::table('translations')
                    ->where('category_type', Amenity::class)->where('key', 'title')
                    ->wherein('value', $request->amenity_name)->pluck('category_id');
                $data = $data->join('property_amenities', 'properties.id', 'property_amenities.property_id')
                    ->wherein('amenity_id', $tanslation->toarray());
            }
            if (isset($request->web)) {
                $data = $data->join('users', 'properties.user_id', 'users.id')->where('users.status', 1)->where('users.approve', 1);
                $data = $data->inRandomOrder();
            }
            return isset($request->paginate) && !empty($request->paginate) ? $data->paginate($request->paginate) : $data->paginate(25);
        });
    }

    public function showData($id)
    {
        return $this->data->with('user.role', 'city', 'country', 'rejoin', 'currency', 'category', 'status', 'type', 'highlight', 'amenity', 'floor_plan', 'title', 'image')->findorFail($id);
    }

    public function sameData($data)
    {
        return $data->with('user.role', 'city', 'country', 'currency', 'title', 'image', 'category', 'type')->where('type_id',$data->type_id)->where('category_id',$data->category_id)->where('status_id',$data->status_id)->get()->random(10);
    }
}
