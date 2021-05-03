<?php

namespace App\Models\Property;

use App\Models\CoreData\Package;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyAmenity extends Model
{
    protected $fillable = [
        'amenity_id','property_id'
    ];
    protected $table = 'property_amenities';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
