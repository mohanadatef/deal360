<?php

namespace App\Models;

use App\Models\Acl\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class View extends Model
{
    protected $fillable = [
      'user_id','ip_address'
    ];
    protected $table = 'views';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function view()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id')->withTrashed();
    }
}
