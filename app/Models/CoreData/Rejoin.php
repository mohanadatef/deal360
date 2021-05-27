<?php

namespace App\Models\CoreData;

use App\Models\Acl\SaveSearch;
use App\Models\Acl\User;
use App\Models\Property\Property;
use App\Models\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rejoin extends Model
{
    protected $fillable = [
        'status','order','city_id','country_id'
    ];
    protected $table = 'rejoins';
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
        return $query->whereStatus($status);
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

    public static function boot() {
        parent::boot();
        static::deleting(function($rejoin) {
            $rejoin->translation()->delete();
        });

        static::restoring(function($rejoin) {
            $rejoin->translation()->withTrashed()->restore();
        });

        static::forceDeleted(function($rejoin) {
            $rejoin->translation()->forceDelete();
        });
    }
}
