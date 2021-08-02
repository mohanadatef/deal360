<?php

namespace App\Models\Property;

use App\Models\Acl\User;
use App\Models\CoreData\Amenity;
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

class PropertyFloorPlan extends Model
{
    protected $fillable = [
        'property_id','size','room','bedroom','bathroom','price'
    ];
    protected $table = 'property_floor_plans';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function property()
    {
        return $this->belongsTo(Property::Class,'property_id');
    }
    public function title()
    {
        return $this->morphone(Translation::class, 'category')
            ->where('key' ,'title')
            ->where('language_id' ,languageId())->withTrashed();
    }

    public function description()
    {
        return $this->morphone(Translation::class, 'category')
            ->where('key' ,'description')
            ->where('language_id' ,languageId())->withTrashed();
    }
    public function translation()
    {
        return $this->morphMany(Translation::class, 'category')->withTrashed();
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'category')->withTrashed();
    }
}
