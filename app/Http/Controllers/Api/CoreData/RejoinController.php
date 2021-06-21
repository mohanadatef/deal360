<?php

namespace App\Http\Controllers\Api\CoreData;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\CoreData\RejoinRepository;
use Illuminate\Http\Request;

class RejoinController extends Controller
{
    private $rejoinRepository;

    public function __construct(RejoinRepository $RejoinRepository)
    {
        $this->rejoinRepository = $RejoinRepository;
    }

    public function listIndex(Request $request)
    {
        return response(['status'=>1,'data'=>$this->rejoinRepository->listData($request->country,$request->city),'message'=>trans('lang.Done')], 200);
    }
}
