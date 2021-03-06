<?php

namespace App\Repositories\CoreData;

use App\Http\Resources\CoreData\Country\CountryListResource;
use App\Http\Resources\CoreData\Country\CountryResource;
use App\Interfaces\MeanInterface;
use App\Models\CoreData\Country;
use App\Traits\ImageTrait;
use App\Traits\ServiceDataTrait;
use Illuminate\Support\Facades\DB;

class CountryRepository implements MeanInterface
{
    use ServiceDataTrait,ImageTrait;

    protected $data;

    public function __construct(Country $Country)
    {
        $this->data = $Country;
    }

    public function getData()
    {
        return $this->data->with('title','image')->order('asc')->get();
    }

    public function storeData($request)
    {
        return DB::transaction(function () use ($request) {
            $data = $this->data->create($request->all());
            $this->storeCheckLanguage($data,$request);
            $imageName = time() . $request->image->getClientOriginalname();
            $image = $data->image()->create(['image' => $imageName]);
            !$image->image ? false : $this->uploadImage($request->image, 'country', $imageName);
            return '<tr id="'.$data->id.'"><td id="title-'.$data->id.'" data-order="'.$data->order.'">'.$data->title->value.'</td>
                <td><img src="'.getImag($data->image,'country').'" id="image-'.$data->id.'" style="width:100px;height: 100px"></td>
                <td><input onfocus="changeStatus('.$data->id.')" type="checkbox" name="status" id="status-'.$data->id.'"
                    checked data-bootstrap-switch data-off-color="danger" data-on-color="success"></td>
                    <td><button type="button" class="btn btn-outline-primary btn-block btn-sm"
                    onclick="showItem('.$data->id.')"><i class="fa fa-edit"></i> '.trans('lang.Edit').'</button>
                    <button id="openModael'.$data->id.'" type="button" class="d-none" data-toggle="modal"
                    data-target="#modal-edit"></button>
                    <button type="button" class="btn btn-outline-danger btn-block btn-sm"
                    onclick="selectItem('.$data->id.')" data-toggle="modal"
                    data-target="#modal-delete"><i></i> '.trans('lang.Delete').'</button></td></tr>';
        });
    }

    public function showData($id)
    {
        return $this->data->with('translation.language','image')->findorFail($id);
    }

    public function updateData($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $data = $this->showData($id);
            $data->update($request->all());
            $this->updateCheckLanguage($data,$request);
            if (isset($request->image)) {
                $this->deleteImage($data->image, 'country');
                $imageName = time() . $request->image->getClientOriginalname();
                $data->image()->forceDelete();
                $image = $data->image()->create(['image' => $imageName]);
                !$image->image ? false : $this->uploadImage($request->image, 'country', $imageName);
            }
            $data = $this->showData($id);
            return new CountryResource($data);
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
        return $this->data->onlyTrashed()->with('translation','image')->order('asc')->get();
    }

    public function restoreData($id)
    {
       $this->data->withTrashed()->find($id)->restore();
    }

    public function removeData($id)
    {
        $data=$this->data->withTrashed()->find($id);
        $this->deleteImage($data->image, 'country');
        $data->forceDelete();
    }

    public function listData()
    {
        return CountryListResource::collection($this->data->status('1')->order('asc')->with('title')->get());
    }
}
