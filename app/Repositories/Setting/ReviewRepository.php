<?php

namespace App\Repositories\Setting;


use App\Events\Api\Setting\RatingEvent;
use App\Interfaces\Setting\ReviewInterface;
use App\Models\Acl\Agency;
use App\Models\Acl\Agent;
use App\Models\Acl\Developer;
use App\Models\Property\Property;
use App\Models\Review;
use App\Traits\ServiceDataTrait;
use Illuminate\Support\Facades\DB;

class ReviewRepository implements ReviewInterface
{
    use ServiceDataTrait;

    protected $data;

    public function __construct(Review $Review)
    {
        $this->data = $Review;
    }

    public function getData()
    {
        return $this->data->with('user')->get();
    }

    public function storeData($request)
    {
        return DB::transaction(function () use ($request) {
            $data['category_id'] = $request->review_id;
            if ($request->type == 'agency') {
                $data['category_type'] = Agency::class;
            } elseif ($request->type == 'agent') {
                $data['category_type'] = Agent::class;
            } elseif ($request->type == 'developer') {
                $data['category_type'] = Developer::class;
            } elseif ($request->type == 'property') {
                $data['category_type'] = Property::class;
            }
            $this->data->create(array_merge($request->all(),$data));
        });
    }

    public function showData($id)
    {
        return $this->data->findorFail($id);
    }

    public function updateStatusData($id)
    {
        $data=$this->showData($id);
        $this->changeStatus($data);
        event(new RatingEvent($id,$data->category_type));
    }

    public function deleteData($id)
    {
        $this->showData($id)->delete();
    }

    public function getDataDelete()
    {
        return $this->data->onlyTrashed()->get();
    }

    public function restoreData($id)
    {
        $this->data->withTrashed()->find($id)->restore();
    }

    public function removeData($id)
    {
        $this->data->withTrashed()->find($id)->forceDelete();
    }

    public function avgRating($id,$type)
    {
        return round($this->data->where('category_id',$id)->where('category_type',$type)->avg('rating'),1);
    }
}
