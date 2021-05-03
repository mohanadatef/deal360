<?php

namespace App\Models\CoreData;

use App\Models\Acl\SaveSearch;
use App\Models\Image;
use App\Models\Property\Property;
use App\Models\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
    protected $fillable = [
        'status','order','code','title'
    ];
    protected $table = 'languages';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

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

    public function translation()
    {
        return $this->hasMany(Translation::class)->withTrashed();
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
        static::deleting(function($language) {
                $language->translation()->delete();
            $language->image()->delete();
        });

        static::restoring(function($language) {
            $language->translation()->withTrashed()->restore();
            $language->image()->withTrashed()->restore();
        });

        static::forceDeleted(function($language) {
            $language->translation()->withTrashed()->forceDelete();
            $language->image()->forceDelete();
        });
    }
}
