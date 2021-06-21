<?php

namespace App\Http\Controllers\Api\CoreData;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\CoreData\AmenityRepository;

class AmenityController extends Controller
{
    private $amenityRepository;

    public function __construct(AmenityRepository $AmenityRepository)
    {
        $this->amenityRepository = $AmenityRepository;
    }

    public function listIndex()
    {
        return response(['status'=>1,'data'=>$this->amenityRepository->listData(),'message'=>trans('lang.Done')], 200);
    }
}
