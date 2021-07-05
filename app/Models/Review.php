<?php

namespace App\Models;

use App\Models\Acl\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    protected $fillable = [
        'title','description','status','rating','user_id','category_type','category_id'
    ];
    protected $table = 'reviews';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function review()
    {
        return $this->morphTo();
    }

    public function scopeStatus($query, $status)
    {
        return $query->whereStatus($status);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id')->with(['role','country'])->withTrashed();
    }
}
