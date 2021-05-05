<?php

namespace App\Repositories\Admin\CoreData;

use App\Http\Resources\Admin\Status\StatusListResource;
use App\Http\Resources\Admin\Status\StatusResource;
use App\Interfaces\Admin\CoreData\CoreDataInterface;
use App\Models\CoreData\Status;
use App\Traits\Service;
use Illuminate\Support\Facades\DB;

class StatusRepository implements CoreDataInterface
{
    use Service;

    protected $status;

    public function __construct(Status $status)
    {
        $this->status = $status;
    }

    public function Get_All_Data()
    {
        return $this->status->with('title')->order('asc')->get();
    }

    public function Create_Data($request)
    {
        return DB::transaction(function () use ($request) {
            $status = $this->status->create($request->all());
            foreach (language() as $lang) {
                $status->translation()->create(['key' => 'title', 'value' => $request->title[$lang->code],
                    'language_id'=>$lang->id]);
            }
            return '<tr id="'.$status->id.'"><td id="title-'.$status->id.'" data-order="'.$status->order.'">'.$status->title.'</td>
                <td><input onfocus="Change_Status('.$status->id.')" type="checkbox" name="status" id="status-'.$status->id.'"
                checked data-bootstrap-switch data-off-color="danger" data-on-color="success"></td>
                <td><button type="button" class="btn btn-outline-primary btn-block btn-sm"
                onclick="ShowItem('.$status->id.')"><i class="fa fa-edit"></i> '.trans('lang.Edit').'</button>
                <button id="openModael'.$status->id.'" type="button" class="d-none" data-toggle="modal"
                data-target="#modal-edit"></button>
                <button type="button" class="btn btn-outline-danger btn-block btn-sm"
                onclick="SelectItem('.$status->id.')" data-toggle="modal"
                data-target="#modal-delete"><i></i> '.trans('lang.Delete').'</button></td></tr>';
        });
    }

    public function Get_Data($id)
    {
        return $this->status->with('translation.language')->findorFail($id);
    }

    public function Update_Data($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $status = $this->Get_Data($id);
            $status->update($request->all());
            foreach (language() as $lang) {
                $translation = $status->translation->where('language_id', $lang->id)->first();
                if ($translation) {
                    $translation->update(['value' => $request->title[$lang->code]]);
                } else {
                    $status->translation()->create(['key' => 'title', 'value' => $request->title[$lang->code],
                        'language_id' => $lang->id]);
                }
            }
            $status = $this->Get_Data($id);
            return new StatusResource($status);
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
        return $this->status->onlyTrashed()->with('translation')->order('asc')->get();
    }

    public function Back_Data_Delete($id)
    {
       $this->status->withTrashed()->find($id)->restore();
    }

    public function Remove_Data($id)
    {
        $this->status->withTrashed()->find($id)->forceDelete();
    }

    public function List_Data()
    {
        return StatusListResource::collection($this->status->status('1')->order('asc')->with('title')->get());
    }
}
