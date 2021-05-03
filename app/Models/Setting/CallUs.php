<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CallUs extends Model
{
    protected $fillable = [
        'title','description','email','phone','status'
    ];
    protected $table = 'call_us';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function scopestatus($query,$status)
    {
        return $query->where('status',$status);
    }
}
