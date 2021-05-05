<?php

namespace App\Repositories\Admin\CoreData;

use App\Http\Resources\Admin\Type\TypeListResource;
use App\Http\Resources\Admin\Type\TypeResource;
use App\Interfaces\Admin\CoreData\CoreDataInterface;
use App\Models\CoreData\Type;
use App\Traits\Service;
use Illuminate\Support\Facades\DB;

class TypeRepository implements CoreDataInterface
{
    use Service;

    protected $type;

    public function __construct(Type $type)
    {
        $this->type = $type;
    }

    public function Get_All_Data()
    {
        return $this->type->with('title','image')->order('asc')->get();
    }

    public function Create_Data($request)
    {
        return DB::transaction(function () use ($request) {
            $type = $this->type->create($request->all());
            foreach (language() as $lang) {
                $type->translation()->create(['key' => 'title', 'value' => $request->title[$lang->code],
                    'language_id'=>$lang->id]);
            }
            $imageName = time() . $request->image->getClientOriginalname();
            $image = $type->image()->create(['image' => $imageName]);
            !$image->image ? false : $this->image_upload($request->image, 'type', $imageName);
            return '<tr id="'.$type->id.'"><td id="title-'.$type->id.'" data-order="'.$type->order.'">'.$type->title->value.'</td>
                <td><img src="'.image_get($type->image,'type').'" id="image-'.$type->id.'" style="width:100px;height: 100px"></td>
                <td><input onfocus="Change_Status('.$type->id.')" type="checkbox" name="status" id="status-'.$type->id.'"
                checked data-bootstrap-switch data-off-color="danger" data-on-color="success"></td>
                <td><button type="button" class="btn btn-outline-primary btn-block btn-sm"
                onclick="ShowItem('.$type->id.')"><i class="fa fa-edit"></i> '.trans('lang.Edit').'</button>
                <button id="openModael'.$type->id.'" type="button" class="d-none" data-toggle="modal"
                data-target="#modal-edit"></button>
                <button type="button" class="btn btn-outline-danger btn-block btn-sm"
                onclick="SelectItem('.$type->id.')" data-toggle="modal"
                data-target="#modal-delete"><i></i> '.trans('lang.Delete').'</button></td></tr>';
        });
    }

    public function Get_Data($id)
    {
        return $this->type->with('translation.language','image')->findorFail($id);
    }

    public function Update_Data($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $type = $this->Get_Data($id);
            $type->update($request->all());
            foreach (language() as $lang) {
                $translation = $type->translation->where('language_id', $lang->id)->first();
                if ($translation) {
                    $translation->update(['value' => $request->title[$lang->code]]);
                } else {
                    $type->translation()->create(['key' => 'title', 'value' => $request->title[$lang->code],
                        'language_id' => $lang->id]);
                }
            }
            if (isset($request->image)) {
                $imageName = time() . $request->image->getClientOriginalname();
                $type->image()->forceDelete();
                $image = $type->image()->create(['image' => $imageName]);
                !$image->image ? false : $this->image_upload($request->image, 'type', $imageName);
            }
            $type = $this->Get_Data($id);
            return new TypeResource($type);
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
        return $this->type->onlyTrashed()->with('translation','image')->order('asc')->get();
    }

    public function Back_Data_Delete($id)
    {
       $this->type->withTrashed()->find($id)->restore();
    }

    public function Remove_Data($id)
    {
        $this->type->withTrashed()->find($id)->forceDelete();
    }

    public function List_Data()
    {
        return TypeListResource::collection($this->type->status('1')->order('asc')->with('title')->get());
    }
}
