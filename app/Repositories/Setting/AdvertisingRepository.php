<?php

namespace App\Repositories\Setting;

use App\Interfaces\Setting\AdvertisingInterface;
use App\Models\Setting\Advertising;
use App\Traits\ServiceDataTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdvertisingRepository implements AdvertisingInterface
{
    use ServiceDataTrait;

    protected $data;

    public function __construct(Advertising $Advertising)
    {
        $this->data = $Advertising;
    }

    public function getData($request)
    {
        $data = $this->data->with('user','image');
        if (isset($request->web)) {
            $data = $data->join('users', 'advertisinies.user_id', 'users.id')
                ->where('users.status', 1)->where('users.approve', 1)
                ->where('advertisinies.started_at','<',Carbon::now())->where('advertisinies.ended_at','>',Carbon::now())
                ->select('advertisinies.*')->inRandomOrder()->limit($request->number);
        }
        return $data->get();
    }

    public function storeData($request)
    {
        return DB::transaction(function () use ($request) {
            $data=$this->data->create($request->all());
            $imageName=time().$request->image->getClientOriginalname();
            $image=$data->image()->create(['image'=>$imageName]);
            !$image->image?false:$this->uploadImage($request->image,'advertising',$imageName);
        });
    }

    public function showData($id)
    {
        return $this->data->with('user','image')->findorFail($id);
    }

    public function updateData($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $data = $this->showData($id);
            $data->update($request->all());
            if(isset($request->image))
            {
                    $this->deleteImage($data->image,'advertising');
                    $imageName=time().$request->image->getClientOriginalname();
                    $data->image()->forceDelete();
                    $image=$data->image()->create(['image'=>$imageName]);
                    !$image->image?false:$this->uploadImage($request->image,'advertising',$imageName);
            }
        });
    }

    public function updateStatusData($id)
    {
        $this->changeStatus($this->showData($id));
    }

    public function updateApproveData($id)
    {
        $this->changeApprove($this->showData($id));
    }

    public function deleteData($id)
    {
        $this->showData($id)->delete();
    }

    public function getDataDelete()
    {
        return $this->data->onlyTrashed()->with('image')->order('asc')->get();
    }

    public function restoreData($id)
    {
        $this->data->withTrashed()->find($id)->restore();
    }

    public function removeData($id)
    {
        $this->data->withTrashed()->find($id)->forceDelete();
    }
}
