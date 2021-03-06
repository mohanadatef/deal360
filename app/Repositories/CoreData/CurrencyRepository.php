<?php

namespace App\Repositories\CoreData;

use App\Http\Resources\CoreData\Currency\CurrencyListResource;
use App\Http\Resources\CoreData\Currency\CurrencyResource;
use App\Interfaces\MeanInterface;
use App\Models\CoreData\Currency;
use App\Traits\ServiceDataTrait;
use Illuminate\Support\Facades\DB;

class CurrencyRepository implements MeanInterface
{
    use ServiceDataTrait;

    protected $data;

    public function __construct(Currency $Currency)
    {
        $this->data = $Currency;
    }

    public function getData()
    {
        return $this->data->with('title')->order('asc')->get();
    }

    public function storeData($request)
    {
        return DB::transaction(function () use ($request) {
            $data = $this->data->create($request->all());
            $this->storeCheckLanguage($data,$request);
            return '<tr id="' . $data->id . '"><td id="title-' . $data->id . '" data-order="' . $data->order . '">' . $data->title . '</td>
                    <td id="country-' . $data->id . '">' . $data->country->title->value . '</td>
                    <td><input onfocus="changeStatus(' . $data->id . ')" type="checkbox" name="status" id="status-' . $data->id . '"
                    checked data-bootstrap-switch data-off-color="danger" data-on-color="success"></td>
                    <td><button type="button" class="btn btn-outline-primary btn-block btn-sm"
                    onclick="showItem(' . $data->id . ')"><i class="fa fa-edit"></i> ' . trans('lang.Edit') . '</button>
                    <button id="openModael' . $data->id . '" type="button" class="d-none" data-toggle="modal"
                    data-target="#modal-edit"></button>
                    <button type="button" class="btn btn-outline-danger btn-block btn-sm"
                    onclick="selectItem(' . $data->id . ')" data-toggle="modal"
                    data-target="#modal-delete"><i></i> ' . trans('lang.Delete') . '</button></td></tr>';
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
            $this->updateCheckLanguage($data,$request);
            $data = $this->showData($id);
            return new CurrencyResource($data);
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
        return CurrencyListResource::collection($this->data->status('1')->order('asc')->with('title')->get());
    }
}
