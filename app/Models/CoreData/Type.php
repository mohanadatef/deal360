<?php

namespace App\Models\CoreData;

use App\Models\Acl\SaveSearch;
use App\Models\Image;
use App\Models\Property\Property;
use App\Models\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    protected $fillable = [
        'status','order'
    ];
    protected $table = 'types';
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
        static::deleting(function($type) {
            $type->image()->delete();
            $type->translation()->delete();
        });

        static::restoring(function($type) {
            $type->image()->withTrashed()->restore();
            $type->translation()->withTrashed()->restore();
        });

        static::forceDeleted(function($type) {
            $type->image()->forceDelete();
            $type->translation()->forceDelete();
        });
    }
}
