<?php

namespace App\Models;

use App\Models\CoreData\Language;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Translation extends Model
{
    protected $fillable = [
        'key','value','language_id'
    ];
    protected $table = 'translations';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function translation()
    {
        return $this->morphTo();
    }

    public function language()
    {
        return $this->belongsTo(Language::class,'language_id')->withTrashed();
    }
}
