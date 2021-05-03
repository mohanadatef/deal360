<?php

namespace App\Models\Property;

use App\Models\CoreData\Package;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserPackageProperty extends Model
{
    protected $fillable = [
        'userpackage_id','property_id'
    ];
    protected $table = 'user_package_properties';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
