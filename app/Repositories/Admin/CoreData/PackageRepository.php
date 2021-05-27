<?php

namespace App\Repositories\Admin\CoreData;

use App\Http\Resources\Admin\CoreData\Package\PackageListResource;
use App\Http\Resources\Admin\CoreData\Package\PackageResource;
use App\Interfaces\Admin\MeanInterface;
use App\Models\CoreData\Package;
use App\Traits\Service;
use Illuminate\Support\Facades\DB;

class PackageRepository implements MeanInterface
{
    use Service;

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
            foreach (language() as $lang) {
                $data->translation()->create(['key' => 'title', 'value' => $request->title[$lang->code],
                    'language_id'=>$lang->id]);
            }
        });
    }

    public function showData($id)
    {
        return $this->data->with('translation.language','currency')->findorFail($id);
    }

    public function updateData($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $data = $this->showData($id);
            $data->update($request->all());
            $data->role()->sync((array)$request->role);
            foreach (language() as $lang) {
                $translation = $data->translation->where('language_id', $lang->id)->first();
                if ($translation) {
                    $translation->update(['value' => $request->title[$lang->code]]);
                } else {
                    $data->translation()->create(['key' => 'title', 'value' => $request->title[$lang->code],
                        'language_id' => $lang->id]);
                }
            }
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
