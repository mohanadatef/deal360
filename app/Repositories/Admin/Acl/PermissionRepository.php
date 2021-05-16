<?php

namespace App\Repositories\Admin\Acl;

use App\Http\Resources\Admin\Acl\Permission\PermissionListResource;
use App\Http\Resources\Admin\Acl\Permission\PermissionResource;
use App\Interfaces\Admin\Acl\PermissionInterface;
use App\Models\Acl\Permission;
use App\Traits\Service;
use Illuminate\Support\Facades\DB;

class PermissionRepository implements PermissionInterface
{
    use Service;

    protected $data;

    public function __construct(Permission $Permission)
    {
        $this->data = $Permission;
    }

    public function getData()
    {
        return $this->data->with('title')->get();
    }

    public function storeData($request)
    {
        return DB::transaction(function () use ($request) {
            $data = $this->data->create($request->all());
            foreach (language() as $lang) {
                $data->translation()->create(['key' => 'title', 'value' => $request->title[$lang->code],
                    'language_id'=>$lang->id]);
            }
            return '<tr id="'.$data->id.'"><td id="title-'.$data->id.'" >'.$data->title->value.'</td>
                <td id="name-'.$data->id.'" >'.$data->name.'</td>
                <td><button data="button" class="btn btn-outline-primary btn-block btn-sm"
                onclick="showItem('.$data->id.')"><i class="fa fa-edit"></i> '.trans('lang.Edit').'</button>
                <button id="openModael'.$data->id.'" data="button" class="d-none" data-toggle="modal"
                data-target="#modal-edit"></button>
                <button data="button" class="btn btn-outline-danger btn-block btn-sm"
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
            return new PermissionResource($data);
        });
    }

    public function deleteData($id)
    {
        $this->showData($id)->delete();
    }

    public function getDataDelete()
    {
        return $this->data->onlyTrashed()->with('translation')->get();
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
        return PermissionListResource::collection($this->data->with('title')->get());
    }
}
