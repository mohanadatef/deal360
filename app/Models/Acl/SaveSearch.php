<?php

namespace App\Models\Acl;

use App\Models\CoreData\Area;
use App\Models\CoreData\Category;
use App\Models\CoreData\City;
use App\Models\CoreData\Country;
use App\Models\CoreData\Language;
use App\Models\CoreData\Type;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaveSearch extends Model
{
    protected $fillable = [
        'user_id','country_id','city_id','area_id','type_id','category_id','title','language_id'
    ];
    protected $table = 'save_searchs';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::Class,'user_id');
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

    public function language()
    {
        return $this->belongsTo(Language::Class,'language_id');
    }
}
