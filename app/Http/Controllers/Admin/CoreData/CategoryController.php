<?php

namespace App\Http\Controllers\Admin\CoreData;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CoreData\Category\CreateRequest;
use App\Http\Requests\Admin\CoreData\Category\EditRequest;
use App\Repositories\CoreData\CategoryRepository;

class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepository $CategoryRepository)
    {
        $this->categoryRepository = $CategoryRepository;
        $this->middleware(['permission:category-list','permission:core-data-list'])->except('listIndex');
        $this->middleware('permission:category-index')->only('index');
        $this->middleware('permission:category-create')->only('store');
        $this->middleware('permission:category-edit')->only('show','update');
        $this->middleware('permission:category-status')->only('changeStatus');
        $this->middleware('permission:category-delete')->only('destroy');
        $this->middleware('permission:category-index-delete')->only('destroyIndex');
        $this->middleware('permission:category-restore')->only('restore');
        $this->middleware('permission:category-remove')->only('remove');
    }

    public function index()
    {
        $datas = $this->categoryRepository->getData();
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
        $datas = $this->categoryRepository->getDataDelete();
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
