<?php

namespace App\Models\Acl;

use App\Models\CoreData\Package;
use App\Models\CoreData\PackageRole;
use App\Models\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    protected $fillable = [
        'code','type_access','status','order'
    ];
    protected $table = 'roles';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function translation()
    {
        return $this->morphMany(Translation::class, 'category')->withTrashed();
    }

    public function title()
    {
        return $this->morphone(Translation::class, 'category')
            ->where('key' ,'title')
            ->where('language_id' ,languageId())->withTrashed();
    }

    public function scopeStatus($query,$status)
    {
        return $query->whereStatus($status);
    }

    public function scopeOrder($query,$order)
    {
        return $query->orderby('order',$order);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function permission()
    {
        return $this->belongsToMany(Permission::Class, 'role_permissions');
    }

    public function role_permission()
    {
        return $this->hasManyThrough(Permission::Class,RolePermission::Class,'role_id','id','id','permission_id');
    }

    public function package()
    {
        return $this->belongsToMany(Package::class, 'package_roles');
    }

    public function package_role()
    {
        return $this->hasMany(PackageRole::Class);
    }

    public static function boot() {
        parent::boot();
        static::deleting(function($role) {
            $role->translation()->delete();
            $role->role_permission()->delete();
            $role->package_role()->delete();
        });

        static::restoring(function($role) {
            $role->translation()->withTrashed()->restore();
            $role->role_permission()->withTrashed()->restore();
            $role->package_role()->withTrashed()->restore();
        });

        static::forceDeleted(function($role) {
            $role->translation()->forceDelete();
            $role->role_permission()->forceDelete();
            $role->package_role()->forceDelete();
        });
    }
}
