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

    public function translation($key)
    {
        return $this->morphOne(Translation::class, 'translation')
            ->where('language_id',languageId())
            ->where('key',$key)
            ->select('value as'.$key);
    }

    public function role()
    {
        return $this->belongsToMany(Role::class, 'rolepermissions');
    }
}
