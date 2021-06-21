<?php

namespace App\Http\Controllers\Api\CoreData;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\CoreData\PackageRepository;

class PackageController extends Controller
{
    private $packageRepository;

    public function __construct(PackageRepository $PackageRepository)
    {
        $this->packageRepository = $PackageRepository;
        $this->middleware('auth:api');
    }

    public function listIndex()
    {
        return response(['status'=>1,'data'=>$this->packageRepository->listData(),'message'=>trans('lang.Done')], 200);
    }
}
