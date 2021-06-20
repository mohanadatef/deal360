<?php

namespace App\Repositories\Admin\CoreData;

use App\Http\Resources\CoreData\Package\PackageListResource;
use App\Http\Resources\CoreData\Package\PackageResource;
use App\Interfaces\Admin\MeanInterface;
use App\Models\CoreData\Package;
use App\Traits\ServiceDataTrait;
use Illuminate\Support\Facades\DB;

class PackageRepository implements MeanInterface
{
    use ServiceDataTrait;

    protected $data;

    public function __construct(Package $Package)
    {
        $this->data = $Package;
    }

    public function getData()
    {
        return $this->data->with('title','package_role','currency')->order('asc')->get();
    }

    public function storeData($request)
    {
        return DB::transaction(function () use ($request) {
            $data = $this->data->create($request->all());
            $data->role()->sync((array)$request->role);
            $this->storeCheckLanguage($data,$request);
        });
    }

    public function showData($id)
    {
        return $this->data->with('translation.language','package_role','currency')->findorFail($id);
    }

    public function updateData($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $data = $this->showData($id);
            $data->update($request->all());
            $data->role()->sync((array)$request->role);
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
        return PackageListResource::collection($this->data->status('1')->order('asc')->with('title')->get());
    }
}
