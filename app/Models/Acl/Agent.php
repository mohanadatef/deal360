<?php

namespace App\Models\Acl;

use App\Models\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agent extends Model
{
    protected $fillable = [
        'user_id','whatsapp','mobile','count_view'
    ];
    protected $table = 'agents';
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

    public function agency()
    {
        return $this->belongsTo(Agency::class, 'agencyagents');
    }
}
