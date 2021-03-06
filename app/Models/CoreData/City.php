<?php

namespace App\Models\CoreData;

use App\Models\Acl\SaveSearch;
use App\Models\Property\Property;
use App\Models\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    protected $fillable = [
        'status','order','country_id'
    ];
    protected $table = 'cities';
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

    public function rejoin()
    {
        return $this->hasMany(Rejoin::class);
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
        static::deleting(function($city) {
            foreach ($city->rejoin as $rejoin)
            {
                $rejoin->delete();
            }
            $city->translation()->delete();
        });

        static::restoring(function($city) {
            foreach ($city->rejoin as $rejoin)
            {
                $rejoin->withTrashed()->restore();
            }
            $city->translation()->withTrashed()->restore();
        });

        static::forceDeleted(function($city) {
            foreach ($city->rejoin as $rejoin)
            {
                $rejoin->forceDelete();
            }
            $city->translation()->forceDelete();
        });
    }
}
