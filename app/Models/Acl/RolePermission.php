<?php

namespace App\Models\Acl;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RolePermission extends Model
{
    protected $fillable = [
        'permission_id','role_id'
    ];
    protected $table = 'role_permissions';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
