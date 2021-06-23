<?php

namespace App\Http\Controllers\Api\Setting;

use App\Http\Controllers\Controller;
use App\Repositories\Setting\MetaRepository;

class MetaController extends Controller
{
    private $metaRepository;

    public function __construct(MetaRepository $MetaRepository)
    {
        $this->metaRepository = $MetaRepository;
    }

    public function listIndex()
    {
        return response(['status'=>1,'data'=>$this->metaRepository->listData(),'message'=>trans('lang.Done')], 200);
    }
}
