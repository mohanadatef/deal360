<?php

namespace App\Http\Controllers\Api\CoreData;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\CoreData\CityRepository;
use Illuminate\Http\Request;

class CityController extends Controller
{
    private $cityRepository;

    public function __construct(CityRepository $CityRepository)
    {
        $this->cityRepository = $CityRepository;
    }

    public function listIndex(Request $request)
    {
        return response(['status'=>1,'data'=>$this->cityRepository->listData($request->country),'message'=>trans('lang.Done')], 200);
    }
}
