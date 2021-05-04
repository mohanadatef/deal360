<?php

namespace App\Repositories\Admin\CoreData;

use App\Http\Resources\Admin\Amenity\AmenityListResource;
use App\Http\Resources\Admin\Amenity\AmenityResource;
use App\Interfaces\Admin\CoreData\CoreDataInterface;
use App\Models\CoreData\Amenity;
use App\Traits\Service;
use Illuminate\Support\Facades\DB;

class AmenityRepository implements CoreDataInterface
{
    use Service;

    protected $amenity;

    public function __construct(Amenity $amenity)
    {
        $this->amenity = $amenity;
    }

    public function Get_All_Data()
    {
        return $this->amenity->with('title', 'image')->order('asc')->get();
    }

    public function Create_Data($request)
    {
        return DB::transaction(function () use ($request) {
            $amenity = $this->amenity->create($request->all());
            foreach (language() as $lang) {
                $amenity->translation()->create(['key' => 'title', 'value' => $request->title[$lang->code],
                    'language_id' => $lang->id]);
            }
            $imageName = time() . $request->image->getClientOriginalname();
            $image = $amenity->image()->create(['image' => $imageName]);
            !$image->image ? false : $this->image_upload($request->image, 'amenity', $imageName);
            return '<tr id="' . $amenity->id . '"><td id="title-' . $amenity->id . '"
            data-order="' . $amenity->order . '">' . $amenity->title->value . '</td>
            <td><img src="'.image_get($amenity->image,'amenity').'" id="image-' . $amenity->id . '" style="width:100px;height: 100px">
            </td> <td><input onfocus="Change_Status(' . $amenity->id . ')" type="checkbox" name="status"
            id="status-' . $amenity->id . '" checked data-bootstrap-switch data-off-color="danger"
            data-on-color="success"></td><td><button type="button"
            class="btn btn-outline-primary btn-block btn-sm" onclick="ShowItem(' . $amenity->id . ')">
            <i class="fa fa-edit"></i> ' . trans('lang.Edit') . '</button>
            <button id="openModael' . $amenity->id . '" type="button" class="d-none" data-toggle="modal"
            data-target="#modal-edit"></button><button type="button" class="btn btn-outline-danger btn-block btn-sm"
            onclick="SelectItem(' . $amenity->id . ')" data-toggle="modal"
            data-target="#modal-delete"><i></i> ' . trans('lang.Delete') . '</button></td></tr>';
        });
    }

    public function Get_Data($id)
    {
        return $this->amenity->with('translation.language', 'image')->findorFail($id);
    }

    public function Update_Data($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $amenity = $this->Get_Data($id);
            $amenity->update($request->all());
            foreach (language() as $lang) {
                $translation = $amenity->translation->where('language_id', $lang->id)->first();
                if ($translation) {
                    $translation->update(['value' => $request->title[$lang->code]]);
                } else {
                    $amenity->translation()->create(['key' => 'title', 'value' => $request->title[$lang->code],
                        'language_id' => $lang->id]);
                }
            }
            if (isset($request->image)) {
                $imageName = time() . $request->image->getClientOriginalname();
                $amenity->image()->forceDelete();
                $image = $amenity->image()->create(['image' => $imageName]);
                !$image->image ? false : $this->image_upload($request->image, 'amenity', $imageName);
            }
            $amenity = $this->Get_Data($id);
            return new AmenityResource($amenity);
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
        return $this->amenity->onlyTrashed()->with('translation', 'image')->order('asc')->get();
    }

    public function Back_Data_Delete($id)
    {
        $this->amenity->withTrashed()->find($id)->restore();
    }

    public function Remove_Data($id)
    {
        $this->amenity->withTrashed()->find($id)->forceDelete();
    }

    public function List_Data()
    {
        return AmenityListResource::collection($this->amenity->status('1')->order('asc')->with('title')->get());
    }
}
