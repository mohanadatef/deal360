<?php

namespace App\Repositories\Admin\Acl;

use App\Http\Resources\Admin\Acl\Role\RoleListResource;
use App\Http\Resources\Admin\Acl\Role\RoleResource;
use App\Interfaces\Admin\MeanInterface;
use App\Models\Acl\Role;
use App\Traits\ServiceDataTrait;
use Illuminate\Support\Facades\DB;

class RoleRepository implements MeanInterface
{
    use ServiceDataTrait;

    protected $data;

    public function __construct(Role $Role)
    {
        $this->data = $Role;
    }

    public function getData()
    {
        return $this->data->with('title','role_permission')->whereKeyNot(1)->get();
    }

    public function storeData($request)
    {
        return DB::transaction(function () use ($request) {
            $data = $this->data->create($request->all());
            $data->permission()->sync((array)$request->permission);
            $this->storeCheckLanguage($data,$request);
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
            $data->permission()->sync((array)$request->permission);
            $data->update($request->all());
            $this->updateCheckLanguage($data,$request);
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
        return RoleListResource::collection($this->data->with('title')->whereKeyNot(1)->status('1')->order('asc')->get());
    }
}
