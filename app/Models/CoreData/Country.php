<?php

namespace App\Models\CoreData;

use App\Models\Acl\Agency;
use App\Models\Acl\SaveSearch;
use App\Models\Acl\User;
use App\Models\Image;
use App\Models\Property\Property;
use App\Models\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    protected $fillable = [
        'status','order'
    ];
    protected $table = 'countries';
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
        return $this->morphOne(Image::class, 'category')->withTrashed();
    }

    public function rejoin()
    {
        return $this->hasMany(Rejoin::class);
    }

    public function city()
    {
        return $this->hasMany(City::class)->withTrashed();
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

    public function user()
    {
        return $this->hasMany(User::Class);
    }
    public function agency()
    {
        return $this->hasMany(Agency::Class);
    }
    public function property()
    {
        return $this->hasmany(Property::Class);
    }

    public static function boot() {
        parent::boot();
        static::deleting(function($country) {
            foreach ($country->city as $city)
            {
                $city->delete();
            }
            foreach ($country->rejoin as $rejoin)
            {
                $rejoin->delete();
            }
            $country->image()->delete();
            $country->translation()->delete();
        });

        static::restoring(function($country) {
            foreach ($country->city as $city)
            {
                $city->withTrashed()->restore();
            }
            foreach ($country->rejoin as $rejoin)
            {
                $rejoin->withTrashed()->restore();
            }
            $country->image()->withTrashed()->restore();
            $country->translation()->withTrashed()->restore();
        });

        static::forceDeleted(function($country) {
            foreach ($country->city as $city)
            {
                $city->withTrashed()->forceDelete();
            }
            foreach ($country->rejoin as $rejoin)
            {
                $rejoin->forceDelete();
            }
            $country->image()->forceDelete();
            $country->translation()->forceDelete();
        });
    }
}
