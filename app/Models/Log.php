<?php

namespace App\Models;

use App\Models\Acl\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Log extends Model
{
    protected $fillable = [
      'user_id','ip_address','url','method','lang'
    ];
    protected $table = 'logs';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id')->withTrashed();
    }
}
