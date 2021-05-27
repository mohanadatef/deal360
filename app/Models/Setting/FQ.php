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

    public function translation($key)
    {
        return $this->morphOne(Translation::class, 'translation')
            ->where('language_id',languageId())
            ->where('key',$key)
            ->select('value as'.$key);
    }

   public function scopeStatus($query,$status)
    {
        return $query->whereStatus($status);
    }

    public function scopeOrder($query,$order)
    {
        return $query->orderby('order',$order);
    }
}
