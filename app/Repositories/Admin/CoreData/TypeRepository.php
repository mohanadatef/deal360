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
            if (count($type->translation->toarray()) != count(language())) {
                throw new \Exception('errors');
            }
            if (!file_exists(public_path('images/type/' . $imageName))) {
                throw new \Exception('errors');
            }
            return new TypeResource($type);
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
            $type = $this->Get_Data($id);
            if (count($type->translation->toarray()) != count(language())) {
                throw new \Exception('errors');
            }
            if (isset($request->image)) {
                $imageName = time() . $request->image->getClientOriginalname();
                $type->image()->forceDelete();
                $image = $type->image()->create(['image' => $imageName]);
                !$image->image ? false : $this->image_upload($request->image, 'type', $imageName);
                $type = $this->Get_Data($id);
                if (file_exists(public_path('images/type/' . $type->image->image)) == false) {
                    throw new \Exception('errors');
                }
            }
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
