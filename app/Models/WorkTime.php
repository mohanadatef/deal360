<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkTime extends Model
{
    protected $fillable = [
        'day','started_at','ended_at'
    ];
    protected $table = 'work_times';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function worktime()
    {
        return $this->morphTo();
    }
}
