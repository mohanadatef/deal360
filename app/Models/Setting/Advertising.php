<?php

namespace App\Models\Setting;

use App\Models\Acl\User;
use App\Models\Image;
use Illuminate\Database\Eloquent\Model;

class Advertising extends Model
{
    protected $fillable = [
        'url','status','approve','user_id','started_at','ended_at'
    ];
    protected $table = 'advertisinies';
    public $timestamps = true;

    public function image()
    {
        return $this->morphOne(Image::class, 'category')->withTrashed();
    }

    public function scopeStatus($query,$status)
    {
        return $query->whereStatus($status);
    }

    public function scopeApprove($query, $approve)
    {
        return $query->whereApprove($approve);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id')->with('country','role')->withTrashed();
    }

}
