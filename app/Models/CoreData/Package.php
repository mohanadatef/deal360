<?php

namespace App\Models\CoreData;

use App\Models\Acl\User;
use App\Models\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    protected $fillable = [
        'status','order','count_listing','type_date','count_date'
    ];
    protected $table = 'packages';
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
            ->where('language_id' ,Language_id()->id)->withTrashed();
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
        return $this->belongsToMany(User::Class, 'user_packages')->withTrashed();
    }

    public static function boot() {
        parent::boot();
        static::deleting(function($package) {
            $package->translation()->delete();
        });

        static::restoring(function($package) {
            $package->translation()->withTrashed()->restore();
        });

        static::forceDeleted(function($package) {
            $package->translation()->forceDelete();
        });
    }
}
