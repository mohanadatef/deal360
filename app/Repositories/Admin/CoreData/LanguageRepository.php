<?php

namespace App\Repositories\Admin\CoreData;



use App\Http\Resources\Admin\Language\LanguageListResource;
use App\Http\Resources\Admin\Language\LanguageResource;
use App\Interfaces\Admin\CoreData\CoreDataInterface;
use App\Models\CoreData\Language;
use App\Traits\Service;
use Illuminate\Support\Facades\DB;

class LanguageRepository implements CoreDataInterface
{
    use Service;

    protected $language;

    public function __construct(Language $language)
    {
        $this->language = $language;
    }

    public function Get_All_Data()
    {
        return $this->language->with('image')->order('asc')->get();
    }

    public function Create_Data($request)
    {
        return DB::transaction(function () use ($request) {
            $language = $this->language->create($request->all());
                $imageName = time() . $request->image->getClientOriginalname();
                $image = $language->image()->create(['image' => $imageName]);
                !$image->image ? false : $this->image_upload($request->image, 'language', $imageName);
            return '<tr id="'.$language->id.'"><td id="title-'.$language->id.'">'.$language->title->value.'</td>
                <td id="code-'.$language->id.'" data-order="${res.order}">'.$language->code.'</td>
                <td><img src="'.image_get($language->image,'language').'" id="image-'.$language->id.'" style="width:100px;height: 100px"></td>
                <td><input onfocus="Change_Status('.$language->id.')" type="checkbox" name="status" id="status-'.$language->id.'"
                checked data-bootstrap-switch data-off-color="danger" data-on-color="success"></td>
                <td><button type="button" class="btn btn-outline-primary btn-block btn-sm"
                onclick="ShowItem('.$language->id.')"><i class="fa fa-edit"></i> '.trans('lang.Edit').'</button>
                 <button id="openModael'.$language->id.'" type="button" class="d-none" data-toggle="modal"
                data-target="#modal-edit"></button>
                    <button type="button" class="btn btn-outline-danger btn-block btn-sm"
                    onclick="SelectItem('.$language->id.')" data-toggle="modal"
                    data-target="#modal-delete"><i></i> '.trans('lang.Delete').'</button></td></tr>';
        });
    }

    public function Get_Data($id)
    {
        return $this->language->with('image')->findorFail($id);
    }

    public function Update_Data($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $language = $this->Get_Data($id);
            $language->update($request->all());
            if (isset($request->image)) {
                $imageName = time() . $request->image->getClientOriginalname();
                $language->image()->forceDelete();
                $image = $language->image()->create(['image' => $imageName]);
                !$image->image ? false : $this->image_upload($request->image, 'language', $imageName);
            }
            return new LanguageResource($language);
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
        return $this->language->onlyTrashed()->with('image')->order('asc')->get();
    }

    public function Back_Data_Delete($id)
    {
        $this->language->withTrashed()->find($id)->restore();
    }

    public function Remove_Data($id)
    {
        $this->language->withTrashed()->find($id)->forceDelete();
    }

    public function List_Data()
    {
      return LanguageListResource::collection($this->language->status('1')->with('image')->order('asc')->get());
    }
}
