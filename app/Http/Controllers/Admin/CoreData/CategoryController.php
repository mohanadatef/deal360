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
        $datas = $this->categoryRepository->getAllData();
        return view(checkView('admin.core_data.category.index'), compact('datas'));
    }

    public function store(CreateRequest $request)
    {
        return response()->json( $this->categoryRepository->storeData($request));
    }

    public function update(EditRequest $request, $id)
    {
        return response()->json($this->categoryRepository->updateData($request, $id));
    }

    public function changeStatus($id)
    {
        $this->categoryRepository->updateStatusData($id);
    }

    public function destroy($id)
    {
        $this->categoryRepository->deleteData($id);
    }

    public function remove($id)
    {;
        $this->categoryRepository->removeData($id);
    }

    public function destroyIndex()
    {
        $datas = $this->categoryRepository->getAllDataDelete();
        return view(checkView('admin.core_data.category.destroy'), compact('datas'));
    }

    public function restore($id)
    {
        $this->categoryRepository->restoreData($id);
    }

    public function listIndex()
    {
        return $this->categoryRepository->listData();
    }

    public function show($id)
    {
        return $this->categoryRepository->showData($id);
    }
}
