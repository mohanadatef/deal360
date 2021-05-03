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
                if (!file_exists(public_path('images/language/' . $imageName))) {
                    throw new \Exception('errors');
                }
            return new LanguageResource($language);
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
                if (file_exists(public_path('images/language/' . $language->image->image)) == false) {
                    throw new \Exception('errors');
                }
            }
            return new LanguageResource($this->Get_Data($id));
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
