<?php

namespace App\Http\Controllers\Api\CoreData;

use App\Http\Controllers\Controller;
use App\Repositories\CoreData\CategoryRepository;

class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepository $CategoryRepository)
    {
        $this->categoryRepository = $CategoryRepository;
    }

    public function listIndex()
    {
        return response(['status'=>1,'data'=>$this->categoryRepository->listData(),'message'=>trans('lang.Done')], 200);
    }
}
