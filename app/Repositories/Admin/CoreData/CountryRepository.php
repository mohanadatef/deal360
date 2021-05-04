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
            if (count($country->translation->toarray()) != count(language())) {
                throw new \Exception('errors');
            }
            if (!file_exists(public_path('images/country/' . $imageName))) {
                throw new \Exception('errors');
            }
            return new CountryResource($country);
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
            $country = $this->Get_Data($id);
            if ($country->translation->count() != count(language())) {
                throw new \Exception('errors');
            }
            if (isset($request->image)) {
                $imageName = time() . $request->image->getClientOriginalname();
                $country->image()->forceDelete();
                $image = $country->image()->create(['image' => $imageName]);
                !$image->image ? false : $this->image_upload($request->image, 'country', $imageName);
                $country = $this->Get_Data($id);
                if (file_exists(public_path('images/country/' . $country->image->image)) == false) {
                    throw new \Exception('errors');
                }
            }
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
