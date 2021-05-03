<?php

namespace App\Models\Setting;

use App\Models\Image;
use App\Models\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    protected $fillable = [
        'facebook','youtube','twitter','instagram', 'phone','email','latitude','longitude'
    ];
    protected $table = 'settings';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function translation($key)
    {
        return $this->morphOne(Translation::class, 'translation')
            ->where('language_id',Language_id())
            ->where('key',$key)
            ->select('value as'.$key);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'image');
    }
}
