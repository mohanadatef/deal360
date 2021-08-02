<?php

namespace App\Http\Controllers\Api\Property;

use App\Events\Api\Setting\ViewEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\Property\Property\PropertyCardResource;
use App\Http\Resources\Property\Property\PropertyResource;
use App\Models\Property\Property;
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
        $paginate=['total_pages'=>ceil($property->Total()/$property->PerPage()),'current_page'=>$property->CurrentPage(),'url_page'=>url('admin/agent?page='),'total'=>$property->Total()];
        $property= PropertyCardResource::collection($property);
        return response(['status' => 1, 'data' => ['properties'=>$property,'paginate'=>$paginate], 'message' => trans('lang.Done')], 200);
    }

    public function show(Request $request)
    {
        $property= $this->propertyRepository->showData($request->id);
        $property->same_property=$this->propertyRepository->sameData($property);
        $property= new PropertyResource($property);//return one
        if (isset($request->auth_id) && !empty($request->auth_id)) {
            event(new ViewEvent($request->id, Property::class, $request->ip(), $request->auth_id));
        }
        return response(['status' => 1, 'data' => $property, 'message' => trans('lang.Done')], 200);
    }

    public function compare(Request $request)
    {
        return response(['status' => 1, 'data' => PropertyCardResource::collection($this->propertyRepository->showData($request->property)), 'message' => trans('lang.Done')], 200);
    }
}
