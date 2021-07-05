<?php

namespace App\Http\Controllers\Api\CoreData;

use App\Http\Controllers\Controller;
use App\Repositories\CoreData\LanguageRepository;

class LanguageController extends Controller
{
    private $languageRepository;

    public function __construct(LanguageRepository $LanguageRepository)
    {
        $this->languageRepository = $LanguageRepository;
    }

    public function listIndex()
    {
        return response(['status'=>1,'data'=>$this->languageRepository->listData(),'message'=>trans('lang.Done')], 200);
    }
}
