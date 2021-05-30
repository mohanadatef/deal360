<?php

namespace App\Repositories\Admin\CoreData;

use App\Http\Resources\Admin\CoreData\Rejoin\RejoinListResource;
use App\Http\Resources\Admin\CoreData\Rejoin\RejoinResource;
use App\Interfaces\Admin\CoreData\RejoinInterface;
use App\Models\CoreData\Rejoin;
use App\Traits\ServiceData;
use Illuminate\Support\Facades\DB;

class RejoinRepository implements RejoinInterface
{
    use ServiceData;

    protected $data;

    public function __construct(Rejoin $Rejoin)
    {
        $this->data = $Rejoin;
    }

    public function getData()
    {
        return $this->data->with('title', 'country.title', 'city.title')->order('asc')->get();
    }

    public function storeData($request)
    {
        return DB::transaction(function () use ($request) {
            $data = $this->data->create($request->all());
            $this->storeCheckLanguage($data,$request);
            return '<tr id="'.$data->id.'"><td id="title-'.$data->id.'" data-order="'.$data->order.'">'.$data->title->value.'</td>
                <td id="country-'.$data->id.'">'.$data->country->title->value.'</td><td id="city-'.$data->id.'">'.$data->city->title->value.'</td>
                   <td><input onfocus="changeStatus('.$data->id.')" type="checkbox" name="status" id="status-'.$data->id.'"
                    checked data-bootstrap-switch data-off-color="danger" data-on-color="success"></td>
                    <td><button type="button" class="btn btn-outline-primary btn-block btn-sm"
                    onclick="showItem('.$data->id.')"><i class="fa fa-edit"></i>'.trans('lang.Edit').' </button>
                    <button id="openModael'.$data->id.'" type="button" class="d-none" data-toggle="modal"
                    data-target="#modal-edit"></button>
                    <button type="button" class="btn btn-outline-danger btn-block btn-sm"
                    onclick="selectItem('.$data->id.')" data-toggle="modal"
                    data-target="#modal-delete"><i></i>'.trans('lang.Delete').' </button></td></tr>';
        });
    }

    public function showData($id)
    {
        return $this->data->with('translation.language', 'country.title', 'city.title')->findorFail($id);
    }

    public function updateData($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $data = $this->showData($id);
            $data->update($request->all());
            $this->updateCheckLanguage($data,$request);
            $data = $this->showData($id);
            return new RejoinResource($data);
        });
    }

    public function updateStatusData($id)
    {
        $this->changeStatus($this->showData($id));
    }

    public function deleteData($id)
    {
        $this->showData($id)->delete();
    }

    public function getDataDelete()
    {
        return $this->data->onlyTrashed()->with('translation')->order('asc')->get();
    }

    public function restoreData($id)
    {
        $this->data->withTrashed()->find($id)->restore();
    }

    public function removeData($id)
    {
        $this->data->withTrashed()->find($id)->forceDelete();
    }

    public function listData($county, $city)
    {
        return RejoinListResource::collection($this->data->status('1')->where('country_id', $county)
            ->where('city_id', $city)->order('asc')->with('title', 'country.title', 'city.title')->get());
    }
}
