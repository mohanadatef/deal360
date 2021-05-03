<?php

namespace App\Models\Acl;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favourite extends Model
{
    protected $fillable = [
        'user_id','property_id'
    ];
    protected $table = 'favourites';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
