<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    protected $fillable = [
        'image'
    ];
    protected $table = 'images';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->morphTo();
    }
}
