<?php

namespace App\Http\Controllers\Api\Setting;

use App\Http\Controllers\Controller;
use App\Http\Resources\Setting\Advertising\AdvertisingResource;
use App\Repositories\Setting\AdvertisingRepository;
use Illuminate\Http\Request;

class AdvertisingController extends Controller
{
    private $advertisingRepository;

    public function __construct(AdvertisingRepository $AdvertisingRepository)
    {
        $this->advertisingRepository = $AdvertisingRepository;
    }

    public function Index(Request $request)
    {
        $request->request->add(['web' => 1]);
        return response(['status'=>1,'data'=>AdvertisingResource::collection($this->advertisingRepository->getData($request)),'message'=>trans('lang.Done')], 200);
    }
}
