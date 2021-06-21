<?php

namespace App\Http\Controllers\Api\CoreData;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\CoreData\CurrencyRepository;

class CurrencyController extends Controller
{
    private $currencyRepository;

    public function __construct(CurrencyRepository $CurrencyRepository)
    {
        $this->currencyRepository = $CurrencyRepository;
    }

    public function listIndex()
    {
        return response(['status'=>1,'data'=>$this->currencyRepository->listData(),'message'=>trans('lang.Done')], 200);
    }
}
