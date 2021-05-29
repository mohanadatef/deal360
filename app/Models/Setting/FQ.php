<?php

namespace App\Models\Setting;

use App\Models\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FQ extends Model
{
    protected $fillable = [
        'status','order'
    ];
    protected $table = 'fqs';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function translation()
    {
        return $this->morphMany(Translation::class, 'category')->withTrashed();
    }

    public function question()
    {
        return $this->morphone(Translation::class, 'category')
            ->where('key' ,'question')
            ->where('language_id' ,languageId())->withTrashed();
    }

    public function answer()
    {
        return $this->morphone(Translation::class, 'category')
            ->where('key' ,'answer')
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
        static::deleting(function($fq) {
            $fq->translation()->delete();
        });

        static::restoring(function($fq) {
            $fq->translation()->withTrashed()->restore();
        });

        static::forceDeleted(function($fq) {
            $fq->translation()->forceDelete();
        });
    }
}
