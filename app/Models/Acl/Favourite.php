<?php

namespace App\Models\Acl;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    protected $fillable = [
        'user_id','property_id'
    ];
    protected $table = 'favourites';
    public $timestamps = true;

}
