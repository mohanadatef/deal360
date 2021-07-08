<?php

namespace App\Http\Controllers\Api\Acl;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Acl\Favourite\CreateRequest;
use App\Http\Resources\Property\Property\PropertyCardResource;
use App\Repositories\Acl\FavouriteRepository;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{

    private $favouriteRepository;

    public function __construct(FavouriteRepository $FavouriteRepository)
    {
        $this->favouriteRepository = $FavouriteRepository;
    }

    public function index(Request $request)
    {
        return response(['status' => 1, 'data' => PropertyCardResource::collection($this->favouriteRepository->getProperty($request->user_id)), 'message' => trans('lang.Done')]);
    }

    public function store(CreateRequest $request)
    {
        $this->favouriteRepository->storeData($request);
        return response(['status' => 1, 'data' => [], 'message' => trans('lang.Done')]);
    }

    public function delete(Request $request)
    {
        $this->favouriteRepository->deleteData($request->user_id, $request->property_id);
        return response(['status' => 1, 'data' => [], 'message' => trans('lang.Done')]);
    }
}
