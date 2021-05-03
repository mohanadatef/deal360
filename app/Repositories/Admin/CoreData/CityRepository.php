<?php

namespace App\Repositories\Admin\CoreData;

use App\Http\Resources\Admin\City\CityListResource;
use App\Http\Resources\Admin\City\CityResource;
use App\Interfaces\Admin\CoreData\CityInterface;
use App\Models\CoreData\City;
use App\Traits\Service;
use Illuminate\Support\Facades\DB;

class CityRepository implements CityInterface
{
    use Service;

    protected $city;

    public function __construct(City $city)
    {
        $this->city = $city;
    }

    public function Get_All_Data()
    {
        return $this->city->with('title','country.title')->order('asc')->get();
    }

    public function Create_Data($request)
    {
        return DB::transaction(function () use ($request) {
            $city = $this->city->create($request->all());
            foreach (language() as $lang) {
                $city->translation()->create(['key' => 'title', 'value' => $request->title[$lang->code],
                    'language_id'=>$lang->id]);
            }
            if (count($city->translation->toarray()) != count(language())) {
                throw new \Exception('errors');
            }
            return new CityResource($city);
        });
    }

    public function Get_Data($id)
    {
        return $this->city->with('translation.language','country.title')->findorFail($id);
    }

    public function Update_Data($request, $id)
    {
        return  DB::transaction(function () use ($request, $id) {
            $city = $this->Get_Data($id);
            $city->update($request->all());
            foreach (language() as $lang) {
                $translation = $city->translation->where('language_id', $lang->id)->first();
                if ($translation) {
                    $translation->update(['value' => $request->titlef[$lang->code]]);
                } else {
                    $city->translation()->create(['key' => 'title', 'value' => $request->title[$lang->code],
                        'language_id' => $lang->id]);
                }
            }
            $city = $this->Get_Data($id);
            if ($city->translation->count() != count(language())) {
                throw new \Exception('errors');
            }
            return new CityResource($city);
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
        return $this->city->onlyTrashed()->with('translation')->order('asc')->get();
    }

    public function Back_Data_Delete($id)
    {
        $this->city->withTrashed()->find($id)->restore();
    }

    public function Remove_Data($id)
    {
        $this->city->withTrashed()->find($id)->forceDelete();
    }

    public function List_Data($county)
    {
        return CityListResource::collection($this->city->status('1')->where('country_id',$county)
            ->order('asc')->with('title','country.title')->get());
    }
}
