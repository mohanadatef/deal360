<?php

namespace App\Http\Controllers\Api\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Setting\Label\CreateRequest;
use App\Http\Requests\Api\Setting\Label\EditRequest;
use App\Http\Resources\Setting\Label\LabelListResource;
use App\Repositories\Setting\LabelRepository;

class LabelController extends Controller
{

    private $labelRepository;

    public function __construct(LabelRepository $LabelRepository)
    {
        $this->labelRepository = $LabelRepository;
    }

    public function index()
    {
        return response(['status' => 1, 'data' => LabelListResource::collection($this->labelRepository->getData()), 'message' => trans('lang.Done')], 200);
    }

    public function store(CreateRequest $request)
    {
        $this->labelRepository->storeData($request);
        return response(['status' => 1, 'data' => [], 'message' => trans('lang.Done')], 200);
    }

    public function update(EditRequest $request)
    {
        $this->labelRepository->updateData($request, $request->id);
        return response(['status' => 1, 'data' => [], 'message' => trans('lang.Done')], 200);
    }
}
