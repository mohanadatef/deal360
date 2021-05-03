<?php

namespace App\Models\Acl;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgencyAgent extends Model
{
    protected $fillable = [
        'agency_id','agent_id'
    ];
    protected $table = 'agency_agents';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
