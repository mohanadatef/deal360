<?php

namespace App\Models\Acl;

use App\Models\CoreData\Area;
use App\Models\CoreData\City;
use App\Models\CoreData\Country;
use App\Models\CoreData\Package;
use App\Models\Image;
use App\Models\Property\Property;
use App\Models\Property\Review;
use App\Models\Translation;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable,SoftDeletes;

    protected $fillable = [
        'username','email','password','remember_token','phone','status','approve','gender','dob',
        'email_verified_at','role_id','country_id','area_id','city_id'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = ['deleted_at'];

    public function image()
    {
        return $this->morphOne(Image::class, 'image');
    }

    public function translation($key)
    {
        return $this->morphOne(Translation::class, 'translation')
            ->where('language_id',Language_id())
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

    public function role()
    {
        return $this->belongsTo(Role::Class,'role_id');
    }

    public function agency()
    {
        return $this->hasOne(Agency::Class);
    }

    public function agent()
    {
        return $this->hasOne(Agent::Class);
    }

    public function forgotpassword()
    {
        return $this->hasmany(ForgotPassword::Class);
    }

    public function savesearch()
    {
        return $this->hasmany(SaveSearch::Class);
    }

    public function review()
    {
        return $this->hasmany(Review::Class);
    }

    public function permission()
    {
        return $this->belongsToMany(Permission::Class, 'role_permissions');
    }

    public function country()
    {
        return $this->belongsTo(Country::Class, 'countries');
    }

    public function city()
    {
        return $this->belongsTo(City::Class, 'cities');
    }

    public function area()
    {
        return $this->belongsTo(Area::Class, 'areas');
    }

    public function favourite()
    {
        return $this->belongsToMany(Property::Class, 'favourites');
    }

    public function package()
    {
        return $this->belongsToMany(Package::Class, 'user_packages');
    }
}
