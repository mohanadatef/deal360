<?php

namespace App\Http\Controllers\Admin\CoreData;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CoreData\Category\CreateRequest;
use App\Http\Requests\Admin\CoreData\Category\EditRequest;
use App\Http\Resources\Admin\Category\CategoryListResource;
use App\Http\Resources\Admin\Category\CategoryResource;
use App\Repositories\Admin\CoreData\CategoryRepository;

class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepository $CategoryRepository)
    {
        $this->categoryRepository = $CategoryRepository;
    }

    public function index()
    {
        $datas = $this->categoryRepository->Get_All_Data();
        return view(check_view('admin.core_data.category.index'), compact('datas'));
    }

    public function store(CreateRequest $request)
    {
        return response()->json( $this->categoryRepository->Create_Data($request));
    }

    public function update(EditRequest $request, $id)
    {
        return response()->json($this->categoryRepository->Update_Data($request, $id));
    }

    public function change_status($id)
    {
        $this->categoryRepository->Update_Status_Data($id);
    }

    public function destroy($id)
    {
        $this->categoryRepository->Delete_Data($id);
    }

    public function remove($id)
    {;
        $this->categoryRepository->Remove_Data($id);
    }

    public function destroy_index()
    {
        $datas = $this->categoryRepository->Get_All_Data_Delete();
        return view(check_view('admin.core_data.category.destroy'), compact('datas'));
    }

    public function restore($id)
    {
        $this->categoryRepository->Back_Data_Delete($id);
    }

    public function list_all()
    {
        return $this->categoryRepository->List_Data();
    }

    public function show($id)
    {
        return $this->categoryRepository->Get_Data($id);
    }
}
