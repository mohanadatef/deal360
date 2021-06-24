<?php

namespace App\Repositories\Property;

use App\Interfaces\Property\PropertyInterface;
use App\Models\CoreData\Status;
use App\Models\Property\Property;

class PropertyRepository implements PropertyInterface
{
    protected $data;

    public function __construct(Property $Property)
    {
        $this->data = $Property;
    }

    public function getData($request)
    {
        $data = $this->data->with('user.role', 'city', 'country', 'currency', 'title','image');
        if (isset($request->status_id) && !empty($request->status_id)) {
            $data = $data->statusid($request->status_id);
        } elseif (isset($request->status_name) && !empty($request->status_name)) {
            $data = $data->status($request->status_name);
        } else {
            $data = $data->status('publish');
        }
        if (isset($request->web)) {
            $data = $data->join('users', 'properties.user_id', 'users.id')
                ->where('users.status', 1)->where('users.approve', 1);
            $data = $data->inRandomOrder();
        }

        return isset($request->paginate) && !empty($request->paginate) ? $data->paginate($request->paginate) : $data->paginate(25);
    }

    public function showData($id)
    {
        return $this->data->with('user.role', 'city', 'country', 'rejoin', 'currency', 'category', 'status', 'type', 'highlight', 'amenity', 'floor_plan', 'title','image')->findorFail($id);
    }
}
