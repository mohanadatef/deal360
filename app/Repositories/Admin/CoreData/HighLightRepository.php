<?php

namespace App\Repositories\Admin\CoreData;

use App\Http\Resources\Admin\CoreData\HighLight\HighLightListResource;
use App\Http\Resources\Admin\CoreData\HighLight\HighLightResource;
use App\Interfaces\Admin\MeanInterface;
use App\Models\CoreData\HighLight;
use App\Traits\Service;
use Illuminate\Support\Facades\DB;

class HighLightRepository implements MeanInterface
{
    use Service;

    protected $data;

    public function __construct(HighLight $HighLight)
    {
        $this->data = $HighLight;
    }

    public function getData()
    {
        return $this->data->with('title')->order('asc')->get();
    }

    public function storeData($request)
    {
        return DB::transaction(function () use ($request) {
            $data = $this->data->create($request->all());
            foreach (language() as $lang) {
                $data->translation()->create(['key' => 'title', 'value' => $request->title[$lang->code],
                    'language_id'=>$lang->id]);
            }
            return '<tr id="'.$data->id.'"><td id="title-'.$data->id.'" data-order="'.$data->order.'">'.$data->title.'</td>
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
        return $this->data->with('translation.language')->findorFail($id);
    }

    public function updateData($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $data = $this->showData($id);
            $data->update($request->all());
            foreach (language() as $lang) {
                $translation = $data->translation->where('language_id', $lang->id)->first();
                if ($translation) {
                    $translation->update(['value' => $request->title[$lang->code]]);
                } else {
                    $data->translation()->create(['key' => 'title', 'value' => $request->title[$lang->code],
                        'language_id' => $lang->id]);
                }
            }
            $data = $this->showData($id);
            return new HighLightResource($data);
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

    public function listData()
    {
        return HighLightListResource::collection($this->data->status('1')->order('asc')->with('title')->get());
    }
}
