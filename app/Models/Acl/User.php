<?php

namespace App\Models\Acl;

use App\Models\CoreData\Country;
use App\Models\CoreData\Package;
use App\Models\Image;
use App\Models\Property\Property;
use App\Models\View;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'username', 'email', 'password', 'token', 'phone', 'status', 'approve', 'gender', 'dob',
        'email_verified_at', 'role_id', 'country_id', 'fullname'
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
        return $this->morphOne(Image::class, 'category')->withTrashed();
    }

    public function scopeStatus($query, $status)
    {
        return $query->whereStatus($status);
    }

    public function scopeOrder($query, $order)
    {
        return $query->orderby('fullname', $order);
    }

    public function scopeApprove($query, $approve)
    {
        return $query->whereApprove($approve);
    }

    public function role()
    {
        return $this->belongsTo(Role::Class, 'role_id')->with(['title'])->withTrashed();
    }

    public function agency()
    {
        return $this->hasOne(Agency::Class)->withTrashed();
    }

    public function developer()
    {
        return $this->hasOne(Developer::Class)->withTrashed();
    }

    public function agent()
    {
        return $this->hasOne(Agent::Class)->withTrashed();
    }

    public function forgotpassword()
    {
        return $this->hasmany(ForgotPassword::Class);
    }

    public function savesearch()
    {
        return $this->hasmany(SaveSearch::Class);
    }

    public function property()
    {
        return $this->hasmany(Property::Class)->with(['user', 'city', 'country', 'rejoin', 'currency', 'category', 'status', 'type', 'highlight', 'amenity', 'floor_plan', 'title', 'image']);
    }

    public function view()
    {
        return $this->hasmany(View::Class);
    }

    public function country()
    {
        return $this->belongsTo(Country::Class, 'country_id')->with('title')->withTrashed();
    }

    public function favourite()
    {
        return $this->belongsToMany(Property::Class, 'favourites');
    }

    public function package()
    {
        return $this->belongsToMany(Package::Class, 'user_packages');
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($user) {
            $user->image()->delete();
            $user->agency()->delete();
            $user->developer()->delete();
            $user->agent()->delete();
        });

        static::restoring(function ($user) {
            $user->image()->withTrashed()->restore();
            $user->agency()->withTrashed()->restore();
            $user->developer()->withTrashed()->restore();
            $user->agent()->withTrashed()->restore();
        });

        static::forceDeleted(function ($user) {
            $user->image()->forceDelete();
            $user->agency()->forceDelete();
            $user->developer()->forceDelete();
            $user->agent()->forceDelete();
        });
    }
}
