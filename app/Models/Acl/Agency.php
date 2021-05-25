<?php

namespace App\Models\Acl;

use App\Models\CoreData\Country;
use App\Models\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agency extends Model
{
    protected $fillable = [
        'user_id','whatsapp','mobile','count_view'
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agencyagents');
    }

    public function country()
    {
        return $this->belongsTo(Country::Class, 'countries');
    }
}
