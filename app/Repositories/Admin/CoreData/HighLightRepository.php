<?php

namespace App\Repositories\Admin\CoreData;

use App\Http\Resources\Admin\HighLight\HighLightListResource;
use App\Http\Resources\Admin\HighLight\HighLightResource;
use App\Interfaces\Admin\CoreData\CoreDataInterface;
use App\Models\CoreData\HighLight;
use App\Traits\Service;
use Illuminate\Support\Facades\DB;

class HighLightRepository implements CoreDataInterface
{
    use Service;

    protected $highlight;

    public function __construct(HighLight $highlight)
    {
        $this->highlight = $highlight;
    }

    public function Get_All_Data()
    {
        return $this->highlight->with('title')->order('asc')->get();
    }

    public function Create_Data($request)
    {
        return DB::transaction(function () use ($request) {
            $highlight = $this->highlight->create($request->all());
            foreach (language() as $lang) {
                $highlight->translation()->create(['key' => 'title', 'value' => $request->title[$lang->code],
                    'language_id'=>$lang->id]);
            }
            if (count($highlight->translation->toarray()) != count(language())) {
                throw new \Exception('errors');
            }
            return new HighLightResource($highlight);
        });
    }

    public function Get_Data($id)
    {
        return $this->highlight->with('translation.language')->findorFail($id);
    }

    public function Update_Data($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $highlight = $this->Get_Data($id);
            $highlight->update($request->all());
            foreach (language() as $lang) {
                $translation = $highlight->translation->where('language_id', $lang->id)->first();
                if ($translation) {
                    $translation->update(['value' => $request->titlef[$lang->code]]);
                } else {
                    $highlight->translation()->create(['key' => 'title', 'value' => $request->title[$lang->code],
                        'language_id' => $lang->id]);
                }
            }
            $highlight = $this->Get_Data($id);
            if ($highlight->translation->count() != count(language())) {
                throw new \Exception('errors');
            }
            return new HighLightResource($highlight);
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
        return $this->highlight->onlyTrashed()->with('translation')->order('asc')->get();
    }

    public function Back_Data_Delete($id)
    {
       $this->highlight->withTrashed()->find($id)->restore();
    }

    public function Remove_Data($id)
    {
        $this->highlight->withTrashed()->find($id)->forceDelete();
    }

    public function List_Data()
    {
        return HighLightListResource::collection($this->highlight->status('1')->order('asc')->with('title')->get());
    }
}
