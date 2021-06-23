<?php

namespace App\Http\Controllers\Api\Setting;

use App\Http\Controllers\Controller;
use App\Repositories\Setting\FQRepository;

class FQController extends Controller
{
    private $FQRepository;

    public function __construct(FQRepository $FQRepository)
    {
        $this->FQRepository = $FQRepository;
    }

    public function listIndex()
    {
        return response(['status'=>1,'data'=>$this->FQRepository->listData(),'message'=>trans('lang.Done')], 200);
    }
}
