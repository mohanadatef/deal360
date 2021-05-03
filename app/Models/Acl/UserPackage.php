<?php

namespace App\Models\Acl;

use App\Models\CoreData\Package;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserPackage extends Model
{
    protected $fillable = [
        'user_id','package_id','started_at','ended_at','count_listing','status'
    ];
    protected $table = 'user_packages';
    public $timestamps = true;

    use SoftDeletes;
    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class,'package_id');
    }
}
