<?php

namespace App\Models\Property;

use App\Models\Acl\User;
use App\Models\CoreData\Amenity;
use App\Models\CoreData\Area;
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
        'status','order','user_id','country_id','city_id','area_id','status_id','type_id','category_id',
        'price','size','room','bedroom','bathroom','bathroom','latitude','longitude','order','high_light_id'
    ];
    protected $table = 'types';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function translation($key)
    {
        return $this->morphOne(Translation::class, 'translation')
            ->where('language_id',languageId())
            ->where('key',$key)
            ->select('value as'.$key);
    }

    public function image()
    {
        return $this->morphmany(Image::class, 'image');
    }

    public function scopeOrder($query,$order)
    {
        return $query->orderby('order',$order);
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

    public function area()
    {
        return $this->belongsTo(Area::Class,'area_id');
    }

    public function type()
    {
        return $this->belongsTo(Type::Class,'type_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::Class,'category_id');
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
}
