<?php

namespace App\Http\Controllers\Api\CoreData;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\CoreData\TypeRepository;

class TypeController extends Controller
{
    private $typeRepository;

    public function __construct(TypeRepository $TypeRepository)
    {
        $this->typeRepository = $TypeRepository;
    }

    public function listIndex()
    {
        return response(['status'=>1,'data'=>$this->typeRepository->listData(),'message'=>trans('lang.Done')], 200);
    }
}
