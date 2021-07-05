<?php

namespace App\Models\Setting;

use App\Models\Translation;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    protected $fillable = [
        'key'
    ];
    protected $table = 'labels';
    public $timestamps = true;

    public function translation()
    {
        return $this->morphMany(Translation::class, 'category')->withTrashed();
    }

    public function translation_language()
    {
        return $this->morphone(Translation::class, 'category')
            ->where('key' ,'title')
            ->where('language_id' ,languageId())->withTrashed();
    }
}
