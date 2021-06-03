<?php

namespace App\Models\Acl;

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
	
	public function translation()
	{
		return $this->morphMany(Translation::class, 'category')->withTrashed();
	}
	
	public function about_me()
	{
		return $this->morphone(Translation::class, 'category')
			->where('key' ,'about_me')
			->where('language_id' ,languageId())->withTrashed();
	}
	
	public function address()
	{
		return $this->morphone(Translation::class, 'category')
			->where('key' ,'address')
			->where('language_id' ,languageId())->withTrashed();
	}
	
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    public function agent()
    {
        return $this->hasMany(Agent::class);
    }
	
	public static function boot() {
		parent::boot();
		static::deleting(function($agency) {
			$agency->user->delete();
		});
		
		static::restoring(function($agency) {
			$agency->user->withTrashed()->restore();
		});
		
		static::forceDeleted(function($agency) {
			$agency->user->forceDelete();
		});
	}
}
