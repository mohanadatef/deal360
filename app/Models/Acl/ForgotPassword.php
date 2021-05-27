<?php

namespace App\Models\Acl;

use App\Models\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ForgotPassword extends Model
{
    protected $fillable = [
        'code','user_id','status'
    ];
    protected $table = 'forgot_passwords';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

   public function scopeStatus($query,$status)
    {
        return $query->whereStatus($status);
    }

    public function user()
    {
        return $this->hasone(User::class,'user_id');
    }
}
