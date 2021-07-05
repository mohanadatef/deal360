<?php

namespace App\Http\Controllers\Api\CoreData;

use App\Http\Controllers\Controller;
use App\Repositories\CoreData\StatusRepository;

class StatusController extends Controller
{
    private $statusRepository;

    public function __construct(StatusRepository $StatusRepository)
    {
        $this->statusRepository = $StatusRepository;
    }

    public function listIndex()
    {
        return response(['status'=>1,'data'=>$this->statusRepository->listData(),'message'=>trans('lang.Done')], 200);
    }
}
