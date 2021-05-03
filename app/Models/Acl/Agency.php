<?php

namespace App\Models\Acl;

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

    public function translation($key)
    {
        return $this->morphOne(Translation::class, 'translation')
            ->where('language_id',Language_id())
            ->where('key',$key)
            ->select('value as'.$key);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agencyagents');
    }
}
