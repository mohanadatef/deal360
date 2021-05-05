<?php

namespace App\Repositories\Admin\CoreData;

use App\Http\Resources\Admin\Package\PackageListResource;
use App\Http\Resources\Admin\Package\PackageResource;
use App\Interfaces\Admin\CoreData\CoreDataInterface;
use App\Models\CoreData\Package;
use App\Traits\Service;
use Illuminate\Support\Facades\DB;

class PackageRepository implements CoreDataInterface
{
    use Service;

    protected $package;

    public function __construct(Package $package)
    {
        $this->package = $package;
    }

    public function Get_All_Data()
    {
        return $this->package->with('title')->order('asc')->get();
    }

    public function Create_Data($request)
    {
        return DB::transaction(function () use ($request) {
            $package = $this->package->create($request->all());
            foreach (language() as $lang) {
                $package->translation()->create(['key' => 'title', 'value' => $request->title[$lang->code],
                    'language_id'=>$lang->id]);
            }
            return '<tr id="'.$package->id.'"><td id="title-'.$package->id.'" data-order="'.$package->order.'">'.$package->title->value.'</td>
                <td id="count-listing-'.$package->id.'">'.$package->count_listing.'</td>
                <td id="type-date-'.$package->id.'">'.trans('lang.'.$package->type_date).'</td>
                <td id="count-date-'.$package->id.'">'.$package->count_date.'</td>
                <td><input onfocus="Change_Status('.$package->id.')" type="checkbox" name="status" id="status-'.$package->id.'"
                checked data-bootstrap-switch data-off-color="danger" data-on-color="success"></td>
                <td><button type="button" class="btn btn-outline-primary btn-block btn-sm"
                onclick="ShowItem('.$package->id.')"><i class="fa fa-edit"></i> '.trans('lang.Edit').'</button>
                <button id="openModael'.$package->id.'" type="button" class="d-none" data-toggle="modal"
                data-target="#modal-edit"></button>
                <button type="button" class="btn btn-outline-danger btn-block btn-sm"
                onclick="SelectItem('.$package->id.')" data-toggle="modal"
                data-target="#modal-delete"><i></i> '.trans('lang.Delete').'</button></td></tr>';
        });
    }

    public function Get_Data($id)
    {
        return $this->package->with('translation.language')->findorFail($id);
    }

    public function Update_Data($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $package = $this->Get_Data($id);
            $package->update($request->all());
            foreach (language() as $lang) {
                $translation = $package->translation->where('language_id', $lang->id)->first();
                if ($translation) {
                    $translation->update(['value' => $request->title[$lang->code]]);
                } else {
                    $package->translation()->create(['key' => 'title', 'value' => $request->title[$lang->code],
                        'language_id' => $lang->id]);
                }
            }
            $package = $this->Get_Data($id);
            return new PackageResource($package);
        });
    }

    public function Update_Status_Data($id)
    {
        $this->change_status($this->Get_Data($id));
    }

    public function Delete_Data($id)
    {
      $this->Get_Data($id)->delete();
    }

    public function Get_All_Data_Delete()
    {
        return $this->package->onlyTrashed()->with('translation')->order('asc')->get();
    }

    public function Back_Data_Delete($id)
    {
       $this->package->withTrashed()->find($id)->restore();
    }

    public function Remove_Data($id)
    {
        $this->package->withTrashed()->find($id)->forceDelete();
    }

    public function List_Data()
    {
        return PackageListResource::collection($this->package->status('1')->order('asc')->with('title')->get());
    }
}
