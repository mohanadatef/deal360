<?php

namespace App\Models\Property;

use App\Models\Acl\User;
use App\Models\CoreData\Package;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    protected $fillable = [
        'title','property_id','description','status','rating','order','user_id'
    ];
    protected $table = 'reviews';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function scopeStatus($query,$status)
    {
        return $query->where('status',$status);
    }

    public function scopeOrder($query,$order)
    {
        return $query->orderby('order',$order);
    }

    public function property()
    {
        return $this->belongsTo(Property::class,'property_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
