<?php

namespace App\Models\CoreData;

use App\Models\Acl\SaveSearch;
use App\Models\Property\Property;
use App\Models\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    protected $fillable = [
        'status','order'
    ];
    protected $table = 'currencies';
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

   public function scopeStatus($query,$status)
    {
        return $query->whereStatus($status);
    }

    public function scopeOrder($query,$order)
    {
        return $query->orderby('order',$order);
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id')->withTrashed();
    }

    public function savesearch()
    {
        return $this->hasmany(SaveSearch::Class);
    }

    public function package()
    {
        return $this->hasmany(Package::Class);
    }

    public function property()
    {
        return $this->hasmany(Property::Class)->withTrashed();
    }

    public static function boot() {
        parent::boot();
        static::deleting(function($currency) {
            $currency->translation()->delete();
        });

        static::restoring(function($currency) {
            $currency->translation()->withTrashed()->restore();
        });

        static::forceDeleted(function($currency) {
            $currency->translation()->forceDelete();
        });
    }
}
