<?php

namespace App\Http\Controllers\Api\Acl;

use App\Http\Controllers\Controller;
use App\Http\Resources\Acl\Developer\DeveloperCardResource;
use App\Http\Resources\Acl\Developer\DeveloperResource;
use App\Repositories\Admin\Acl\DeveloperRepository;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    private $developerRepository;

    public function __construct(DeveloperRepository $DeveloperRepository)
    {
        $this->developerRepository = $DeveloperRepository;
    }

    public function index(Request $request)
    {
        $request->request->add(['status' => 1]);
        $developer=$this->developerRepository->getData($request);
        $paginate=['total_pages'=>ceil($developer->Total()/$developer->PerPage()),'current_page'=>$developer->CurrentPage(),'url_page'=>url('admin/developer?page=')];
        $developer= DeveloperCardResource::collection($developer);
        return response(['status' => 1, 'data' => ['data'=>$developer,'paginate'=>$paginate], 'message' => trans('lang.Done')], 200);
    }

    public function show(Request $request)
    {
        $developer= new DeveloperResource($this->developerRepository->showData($request->id));//return one
        return response(['status' => 1, 'data' => $developer, 'message' => trans('lang.Done')], 200);
    }
}
