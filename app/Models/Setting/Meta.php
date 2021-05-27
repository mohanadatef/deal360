<?php

namespace App\Models\Setting;

use App\Models\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meta extends Model
{
    protected $fillable = [
        'status','order'
    ];
    protected $table = 'metas';
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

    public static function boot() {
        parent::boot();
        static::deleting(function($meta) {
            $meta->translation()->delete();
        });

        static::restoring(function($meta) {
            $meta->translation()->withTrashed()->restore();
        });

        static::forceDeleted(function($meta) {
            $meta->translation()->forceDelete();
        });
    }
}
