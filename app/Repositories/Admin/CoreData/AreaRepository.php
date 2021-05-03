<?php

namespace App\Repositories\Admin\CoreData;

use App\Http\Resources\Admin\Area\AreaListResource;
use App\Http\Resources\Admin\Area\AreaResource;
use App\Interfaces\Admin\CoreData\AreaInterface;
use App\Models\CoreData\Area;
use App\Traits\Service;
use Illuminate\Support\Facades\DB;

class AreaRepository implements AreaInterface
{
    use Service;

    protected $area;

    public function __construct(Area $area)
    {
        $this->area = $area;
    }

    public function Get_All_Data()
    {
        return $this->area->with('title', 'country.title', 'city.title')->order('asc')->get();
    }

    public function Create_Data($request)
    {
        return DB::transaction(function () use ($request) {
            $area = $this->area->create($request->all());
            foreach (language() as $lang) {
                $area->translation()->create(['key' => 'title', 'value' => $request->title[$lang->code],
                    'language_id' => $lang->id]);
            }
            if (count($area->translation->toarray()) != count(language())) {
                throw new \Exception('errors');
            }
            return new AreaResource($area);
        });
    }

    public function Get_Data($id)
    {
        return $this->area->with('translation.language', 'country.title')->findorFail($id);
    }

    public function Update_Data($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $area = $this->Get_Data($id);
            $area->update($request->all());
            foreach (language() as $lang) {
                $translation = $area->translation->where('language_id', $lang->id)->first();
                if ($translation) {
                    $translation->update(['value' => $request->titlef[$lang->code]]);
                } else {
                    $area->translation()->create(['key' => 'title', 'value' => $request->title[$lang->code],
                        'language_id' => $lang->id]);
                }
            }
            $area = $this->Get_Data($id);
            if (count($area->translation->toarray()) != count(language())) {
                throw new \Exception('errors');
            }
            return new AreaResource($area);
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
        return $this->area->onlyTrashed()->with('translation')->order('asc')->get();
    }

    public function Back_Data_Delete($id)
    {
        $this->area->withTrashed()->find($id)->restore();
    }

    public function Remove_Data($id)
    {
        $this->area->withTrashed()->find($id)->forceDelete();
    }

    public function List_Data($county, $city)
    {
        return AreaListResource::collection($this->area->status('1')->where('country_id', $county)
            ->where('city_id', $city)->order('asc')->with('title', 'country.title')->get());
    }
}
