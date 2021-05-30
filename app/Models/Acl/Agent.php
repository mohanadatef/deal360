<?php

namespace App\Models\Acl;

use App\Models\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agent extends Model
{
    protected $fillable = [
        'user_id'
    ];
    protected $table = 'agents';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class, 'agency_agents');
    }
}
