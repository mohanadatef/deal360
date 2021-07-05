<?php

namespace App\Models\Acl;

use App\Models\Translation;
use App\Models\WorkTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agent extends Model
{
    protected $fillable = [
        'user_id','company_id'
    ];
    protected $table = 'agents';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id')->with('country','role')->withTrashed();
    }

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

    public function agency()
    {
        return $this->belongsTo(Agency::class, 'company_id')->withTrashed();
    }

    public function developer()
    {
        return $this->belongsTo(Developer::class, 'company_id')->withTrashed();
    }

	public function company()
	{
		return $this->belongsTo(User::class, 'company_id')->withTrashed();
	}

    public function worktime()
    {
        return $this->morphMany(WorkTime::class, 'category')->withTrashed();
    }

    public function day($day)
    {
        return $this->morphone(WorkTime::class, 'category')
            ->where('day' ,$day)->withTrashed();
    }

	public static function boot() {
		parent::boot();
		static::deleting(function($agent) {
			$agent->user->delete();
			$agent->translation()->delete();
		});

		static::restoring(function($agent) {
			$agent->user->withTrashed()->restore();
			$agent->translation()->withTrashed()->restore();
		});

		static::forceDeleted(function($agent) {
			$agent->translation()->forceDelete();
			$agent->user->forceDelete();
		});
	}
}
