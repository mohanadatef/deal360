<?php

namespace App\Models\Acl;

use App\Models\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Developer extends Model
{
    protected $fillable = [
        'user_id'
    ];
    protected $table = 'developers';
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
	
	public function agent()
	{
		return $this->hasMany(Agent::class,'company_id')->withTrashed();
	}
	
	public function user()
	{
		return $this->belongsTo(User::class, 'user_id')->withTrashed();
	}
	
	public static function boot() {
		parent::boot();
		static::deleting(function($developer) {
			$developer->user->delete();
			$developer->translation()->delete();
			foreach($developer->agent as $agent)
			{
				$agent->delete();
			}
		});
		
		static::restoring(function($developer) {
			$developer->user->withTrashed()->restore();
			$developer->translation()->withTrashed()->restore();
			foreach($developer->agent as $agent)
			{
				$agent->withTrashed()->restore();
			}
		});
		
		static::forceDeleted(function($developer) {
			$developer->translation()->forceDelete();
			$developer->user->forceDelete();
			foreach($developer->agent as $agent)
			{
				$agent->forceDelete();
			}
		});
	}
}
