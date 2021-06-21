<?php

namespace App\Http\Controllers\Api\CoreData;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\CoreData\CountryRepository;

class CountryController extends Controller
{
    private $countryRepository;

    public function __construct(CountryRepository $CountryRepository)
    {
        $this->countryRepository = $CountryRepository;
    }

    public function listIndex()
    {
        return response(['status'=>1,'data'=>$this->countryRepository->listData(),'message'=>trans('lang.Done')], 200);
    }
}
