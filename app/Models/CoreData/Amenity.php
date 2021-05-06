<?php

namespace App\Models\CoreData;

use App\Models\Image;
use App\Models\Property\Property;
use App\Models\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Amenity extends Model
{
    protected $fillable = [
        'status','order'
    ];
    protected $table = 'amenities';
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

    public function scopeStatus($query,$status)
    {
        return $query->where('status',$status);
    }

    public function scopeOrder($query,$order)
    {
        return $query->orderby('order',$order);
    }

    public function property()
    {
        return $this->belongsToMany(Property::Class, 'property_amenities');
    }

    public static function boot() {
        parent::boot();
        static::deleting(function($amenity) {
            $amenity->image()->delete();
            $amenity->translation()->delete();
        });

        static::restoring(function($amenity) {
            $amenity->image()->withTrashed()->restore();
            $amenity->translation()->withTrashed()->restore();
        });

        static::forceDeleted(function($amenity) {
            $amenity->image()->forceDelete();
            $amenity->translation()->forceDelete();
        });
    }
}
