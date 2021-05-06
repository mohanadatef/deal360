<?php

namespace App\Models\CoreData;

use App\Models\Acl\SaveSearch;
use App\Models\Acl\User;
use App\Models\Property\Property;
use App\Models\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    protected $fillable = [
        'status','order','city_id','country_id'
    ];
    protected $table = 'areas';
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

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id')->withTrashed();
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id')->withTrashed();
    }

    public function scopeStatus($query,$status)
    {
        return $query->where('status',$status);
    }

    public function scopeOrder($query,$order)
    {
        return $query->orderby('order',$order);
    }

    public function savesearch()
    {
        return $this->hasmany(SaveSearch::Class);
    }

    public function property()
    {
        return $this->hasmany(Property::Class);
    }

    public function user()
    {
        return $this->hasMany(User::Class);
    }

    public static function boot() {
        parent::boot();
        static::deleting(function($area) {
            $area->translation()->delete();
        });

        static::restoring(function($area) {
            $area->translation()->withTrashed()->restore();
        });

        static::forceDeleted(function($area) {
            $area->translation()->forceDelete();
        });
    }
}
