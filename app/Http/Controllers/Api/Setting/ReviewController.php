<?php

namespace App\Http\Controllers\Api\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Setting\Review\CreateRequest;
use App\Repositories\Setting\ReviewRepository;

class ReviewController extends Controller
{

    private $reviewRepository;

    public function __construct(ReviewRepository $ReviewRepository)
    {
        $this->reviewRepository = $ReviewRepository;
    }


    public function store(CreateRequest $request)
    {
        $this->reviewRepository->storeData($request);
        return response(['status' => 1, 'data' => [], 'message' => trans('lang.Done')], 200);
    }
}
