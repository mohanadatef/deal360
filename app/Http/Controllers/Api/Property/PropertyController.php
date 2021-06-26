<?php

namespace App\Http\Controllers\Api\Property;

use App\Http\Controllers\Controller;
use App\Http\Resources\Property\Property\PropertyCardResource;
use App\Http\Resources\Property\Property\PropertyResource;
use App\Repositories\Property\PropertyRepository;
use Illuminate\Http\Request;

class PropertyController extends Controller
{

    private $propertyRepository;

    public function __construct(PropertyRepository $PropertyRepository)
    {
        $this->propertyRepository = $PropertyRepository;
    }

    public function index(Request $request)
    {
        $request->request->add(['web' => 1]);
        $property=$this->propertyRepository->getData($request);
        $paginate=['total_pages'=>ceil($property->Total()/$property->PerPage()),'current_page'=>$property->CurrentPage(),'url_page'=>url('admin/agent?page=')];
        $property= PropertyCardResource::collection($property);
        return response(['status' => 1, 'data' => ['data'=>$property,'paginate'=>$paginate], 'message' => trans('lang.Done')], 200);
    }

    public function show(Request $request)
    {
        $property= new PropertyResource($this->propertyRepository->showData($request->id));//return one
        return response(['status' => 1, 'data' => $property, 'message' => trans('lang.Done')], 200);
    }

    public function compare(Request $request)
    {
        $request->request->add(['web_compare' => 1]);
        $property=$this->propertyRepository->getData($request);
        return response(['status' => 1, 'data' => PropertyCardResource::collection($property), 'message' => trans('lang.Done')], 200);
    }
}
