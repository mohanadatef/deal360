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
            if (count($status->translation->toarray()) != count(language())) {
                throw new \Exception('errors');
            }
            return new StatusResource($status);
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
            if ($status->translation->count() != count(language())) {
                throw new \Exception('errors');
            }
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
