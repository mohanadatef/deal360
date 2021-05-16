<?php

namespace App\Models\Acl;

use App\Models\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    protected $fillable = [
        'name'
    ];
    protected $table = 'permissions';
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

    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_permissions');
    }

    public static function boot() {
        parent::boot();
        static::deleting(function($permission) {
            $permission->translation()->delete();
            $permission->role()->delete();
        });

        static::restoring(function($permission) {
            $permission->translation()->withTrashed()->restore();
            $permission->role()->withTrashed()->restore();
        });

        static::forceDeleted(function($permission) {
            $permission->translation()->forceDelete();
            $permission->role()->forceDelete();
        });
    }
}
