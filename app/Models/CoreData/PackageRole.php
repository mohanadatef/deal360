<?php

namespace App\Models\CoreData;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackageRole extends Model
{
    protected $fillable = [
        'package_id','role_id'
    ];
    protected $table = 'package_roles';
    public $timestamps = true;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    public static function boot() {
        parent::boot();
        static::deleting(function($package_role) {
            $package_role->delete();
        });

        static::restoring(function($package_role) {
            $package_role->withTrashed()->restore();
        });

        static::forceDeleted(function($package_role) {
            $package_role->forceDelete();
        });
    }
}
