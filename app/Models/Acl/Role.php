<?php

namespace App\Models\Acl;

use App\Models\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    protected $fillable = [
        'code','type_access','status','order'
    ];
    protected $table = 'roles';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function translation($key)
    {
        return $this->morphOne(Translation::class, 'translation')
            ->where('language_id',languageId())
            ->where('key',$key)
            ->select('value as'.$key);
    }

    public function scopeStatus($query,$status)
    {
        return $query->where('status',$status);
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
        return $this->belongsToMany(Permission::Class, 'rolepermissions');
    }
}
