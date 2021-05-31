<?php

namespace App\Models\Acl;

use App\Models\CoreData\Country;
use App\Models\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agency extends Model
{
    protected $fillable = [
        'user_id'
    ];
    protected $table = 'agencies';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agent()
    {
        return $this->hasMany(Agent::class);
    }
}
