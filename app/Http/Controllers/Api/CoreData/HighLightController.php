<?php

namespace App\Http\Controllers\Api\CoreData;

use App\Http\Controllers\Controller;
use App\Repositories\CoreData\HighLightRepository;

class HighLightController extends Controller
{
    private $highlightRepository;

    public function __construct(HighLightRepository $HighLightRepository)
    {
        $this->highlightRepository = $HighLightRepository;

    }

    public function listIndex()
    {
        return response(['status'=>1,'data'=>$this->highlightRepository->listData(),'message'=>trans('lang.Done')], 200);
    }
}
