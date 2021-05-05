<?php

namespace App\Repositories\Admin\CoreData;

use App\Http\Resources\Admin\Country\CountryListResource;
use App\Http\Resources\Admin\Country\CountryResource;
use App\Interfaces\Admin\CoreData\CoreDataInterface;
use App\Models\CoreData\Country;
use App\Traits\Service;
use Illuminate\Support\Facades\DB;

class CountryRepository implements CoreDataInterface
{
    use Service;

    protected $country;

    public function __construct(Country $country)
    {
        $this->country = $country;
    }

    public function Get_All_Data()
    {
        return $this->country->with('title','image')->order('asc')->get();
    }

    public function Create_Data($request)
    {
        return DB::transaction(function () use ($request) {
            $country = $this->country->create($request->all());
            foreach (language() as $lang) {
                $country->translation()->create(['key' => 'title', 'value' => $request->title[$lang->code],
                    'language_id'=>$lang->id]);
            }
            $imageName = time() . $request->image->getClientOriginalname();
            $image = $country->image()->create(['image' => $imageName]);
            !$image->image ? false : $this->image_upload($request->image, 'country', $imageName);
            return '<tr id="'.$country->id.'"><td id="title-'.$country->id.'" data-order="'.$country->order.'">'.$country->title->value.'</td>
                <td><img src="'.image_get($country->image,'country').'" id="image-'.$country->id.'" style="width:100px;height: 100px"></td>
                <td><input onfocus="Change_Status('.$country->id.')" type="checkbox" name="status" id="status-'.$country->id.'"
                    checked data-bootstrap-switch data-off-color="danger" data-on-color="success"></td>
                    <td><button type="button" class="btn btn-outline-primary btn-block btn-sm"
                    onclick="ShowItem('.$country->id.')"><i class="fa fa-edit"></i> '.trans('lang.Edit').'</button>
                    <button id="openModael'.$country->id.'" type="button" class="d-none" data-toggle="modal"
                    data-target="#modal-edit"></button>
                    <button type="button" class="btn btn-outline-danger btn-block btn-sm"
                    onclick="SelectItem('.$country->id.')" data-toggle="modal"
                    data-target="#modal-delete"><i></i> '.trans('lang.Delete').'</button></td></tr>';
        });
    }

    public function Get_Data($id)
    {
        return $this->country->with('translation.language','image')->findorFail($id);
    }

    public function Update_Data($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $country = $this->Get_Data($id);
            $country->update($request->all());
            foreach (language() as $lang) {
                $translation = $country->translation->where('language_id', $lang->id)->first();
                if ($translation) {
                    $translation->update(['value' => $request->title[$lang->code]]);
                } else {
                    $country->translation()->create(['key' => 'title', 'value' => $request->title[$lang->code],
                        'language_id' => $lang->id]);
                }
            }
            if (isset($request->image)) {
                $imageName = time() . $request->image->getClientOriginalname();
                $country->image()->forceDelete();
                $image = $country->image()->create(['image' => $imageName]);
                !$image->image ? false : $this->image_upload($request->image, 'country', $imageName);
            }
            $country = $this->Get_Data($id);
            return new CountryResource($country);
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
        return $this->country->onlyTrashed()->with('translation','image')->order('asc')->get();
    }

    public function Back_Data_Delete($id)
    {
       $this->country->withTrashed()->find($id)->restore();
    }

    public function Remove_Data($id)
    {
        $this->country->withTrashed()->find($id)->forceDelete();
    }

    public function List_Data()
    {
        return CountryListResource::collection($this->country->status('1')->order('asc')->with('title')->get());
    }
}
