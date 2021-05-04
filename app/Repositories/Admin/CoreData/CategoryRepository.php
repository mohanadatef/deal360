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
            return '<tr id="'.$category->id.'"><td id="title-'.$category->id.'" data-order="${res.order}">'.$category->title->value.'</td>
                            <td><img src="'.image_get($category->image,'category').'" id="image-'.$category->id.'" style="width:100px;height: 100px"></td>
                            <td><input onfocus="Change_Status('.$category->id.')" type="checkbox" name="status" id="status-'.$category->id.'"
                                checked data-bootstrap-switch data-off-color="danger" data-on-color="success"></td>
                                <td><button type="button" class="btn btn-outline-primary btn-block btn-sm"
                                onclick="ShowItem('.$category->id.')"><i class="fa fa-edit"></i> '.trans('lang.Edit').'</button>
                                <button id="openModael'.$category->id.'" type="button" class="d-none" data-toggle="modal"
                                data-target="#modal-edit"></button>
                                <button type="button" class="btn btn-outline-danger btn-block btn-sm"
                                onclick="SelectItem('.$category->id.')" data-toggle="modal"
                                data-target="#modal-delete"><i></i> '.trans('lang.Delete').'</button></td></tr>';
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
                    $translation->update(['value' => $request->title[$lang->code]]);
                } else {
                    $category->translation()->create(['key' => 'title', 'value' => $request->title[$lang->code],
                        'language_id' => $lang->id]);
                }
            }
            if (isset($request->image)) {
                $imageName = time() . $request->image->getClientOriginalname();
                $category->image()->forceDelete();
                $image = $category->image()->create(['image' => $imageName]);
                !$image->image ? false : $this->image_upload($request->image, 'category', $imageName);
            }
            $category = $this->Get_Data($id);
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
