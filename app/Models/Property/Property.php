<?php

namespace App\Models\Property;

use App\Models\Acl\User;
use App\Models\CoreData\Amenity;
use App\Models\CoreData\Currency;
use App\Models\CoreData\Rejoin;
use App\Models\CoreData\Category;
use App\Models\CoreData\City;
use App\Models\CoreData\Country;
use App\Models\CoreData\HighLight;
use App\Models\CoreData\Status;
use App\Models\CoreData\Type;
use App\Models\Image;
use App\Models\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    protected $fillable = [
        'status','order','user_id','country_id','city_id','rejoin_id','status_id','type_id','category_id','virtual_tour','available_from',
        'price','size','lot_size','room','bedroom','bathroom','garage','bathroom','latitude','longitude','order','high_light_id','youtube_id','currency_id'
    ];
    protected $table = 'properties';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function translation()
    {
        return $this->morphMany(Translation::class, 'category')->withTrashed();
    }

    public function title()
    {
        return $this->morphone(Translation::class, 'category')
            ->where('key' ,'title')
            ->where('language_id' ,languageId())->withTrashed();
    }

    public function image()
    {
        return $this->morphMany(Image::class, 'category')->withTrashed();
    }

    public function scopeOrder($query,$order)
    {
        return $query->orderby('order',$order);
    }

    public function scopeStatusName($query,$status)
    {
        return $query->join('translations', 'properties.status_id', 'translations.category_id')
            ->where('translations.category_type', Status::class)->where('translations.key', 'title')
            ->where('translations.value', $status);
    }

    public function scopeStatusId($query,$status_id)
    {
        return $query->where('status_id',$status_id);
    }

    public function user()
    {
        return $this->belongsTo(User::Class,'user_id');
    }

    public function favourite()
    {
        return $this->belongsToMany(User::Class, 'favourites');
    }

    public function package()
    {
        return $this->belongsToMany(UserPackageProperty::Class, 'user_package_properties');
    }

    public function country()
    {
        return $this->belongsTo(Country::Class,'country_id');
    }

    public function city()
    {
        return $this->belongsTo(City::Class,'city_id');
    }

    public function rejoin()
    {
        return $this->belongsTo(Rejoin::Class,'rejoin_id');
    }

    public function type()
    {
        return $this->belongsTo(Type::Class,'type_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::Class,'category_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::Class,'currency_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::Class,'status_id');
    }

    public function amenity()
    {
        return $this->belongsToMany(Amenity::Class, 'property_amenities');
    }

    public function highlight()
    {
        return $this->belongsTo(HighLight::Class,'high_light_id');
    }

    public function floor_plan()
    {
        return $this->hasMany(PropertyFloorPlan::Class);
    }
}
