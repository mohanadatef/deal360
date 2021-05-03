<?php

namespace App\Repositories\Admin\CoreData;

use App\Http\Resources\Admin\Category\CategoryListResource;
use App\Http\Resources\Admin\Category\CategoryResource;
use App\Interfaces\Admin\CoreData\CoreDataInterface;
use App\Models\CoreData\Category;
use App\Traits\Service;
use Illuminate\Support\Facades\DB;

class CategoryRepository implements CoreDataInterface
{
    use Service;

    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function Get_All_Data()
    {
        return $this->category->with('title','image')->order('asc')->get();
    }

    public function Create_Data($request)
    {
        return DB::transaction(function () use ($request) {
            $category = $this->category->create($request->all());
            foreach (language() as $lang) {
                $category->translation()->create(['key' => 'title', 'value' => $request->title[$lang->code],
                    'language_id'=>$lang->id]);
            }
            $imageName = time() . $request->image->getClientOriginalname();
            $image = $category->image()->create(['image' => $imageName]);
            !$image->image ? false : $this->image_upload($request->image, 'category', $imageName);
            if (count($category->translation->toarray()) != count(language())) {
                throw new \Exception('errors');
            }
            if (!file_exists(public_path('images/category/' . $imageName))) {
                throw new \Exception('errors');
            }
            return new CategoryResource($category);
        });
    }

    public function Get_Data($id)
    {
        return $this->category->with('translation.language','image')->findorFail($id);
    }

    public function Update_Data($request, $id)
    {
        return  DB::transaction(function () use ($request, $id) {
            $category = $this->Get_Data($id);
            $category->update($request->all());
            foreach (language() as $lang) {
                $translation = $category->translation->where('language_id', $lang->id)->first();
                if ($translation) {
                    $translation->update(['value' => $request->titlef[$lang->code]]);
                } else {
                    $category->translation()->create(['key' => 'title', 'value' => $request->title[$lang->code],
                        'language_id' => $lang->id]);
                }
            }
            $category = $this->Get_Data($id);
            if ($category->translation->count() != count(language())) {
                throw new \Exception('errors');
            }
            if (isset($request->image)) {
                $imageName = time() . $request->image->getClientOriginalname();
                $category->image()->forceDelete();
                $image = $category->image()->create(['image' => $imageName]);
                !$image->image ? false : $this->image_upload($request->image, 'category', $imageName);
                $category = $this->Get_Data($id);
                if (file_exists(public_path('images/category/' . $category->image->image)) == false) {
                    throw new \Exception('errors');
                }
            }
            return new CategoryResource($category);
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
        return $this->category->onlyTrashed()->with('translation','image')->order('asc')->get();
    }

    public function Back_Data_Delete($id)
    {
       $this->category->withTrashed()->find($id)->restore();
    }

    public function Remove_Data($id)
    {
        $this->category->withTrashed()->find($id)->forceDelete();
    }

    public function List_Data()
    {
        return CategoryListResource::collection($this->category->status('1')->order('asc')->with('title')->get());
    }
}
