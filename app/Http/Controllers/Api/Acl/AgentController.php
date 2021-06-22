<?php

namespace App\Http\Controllers\Api\Acl;

use App\Http\Controllers\Controller;
use App\Http\Resources\Acl\Agent\AgentCardResource;
use App\Http\Resources\Acl\Agent\AgentResource;
use App\Repositories\Acl\AgentRepository;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    private $agentRepository;

    public function __construct(AgentRepository $AgentRepository)
    {
        $this->agentRepository = $AgentRepository;
    }

    //get all agent available
    public function index(Request $request)
    {
        $request->request->add(['status' => 1]);
        $agent=$this->agentRepository->getData($request);
        $paginate=['total_pages'=>ceil($agent->Total()/$agent->PerPage()),'current_page'=>$agent->CurrentPage(),'url_page'=>url('admin/agent?page=')];
        $agent= AgentCardResource::collection($agent);
        return response(['status' => 1, 'data' => ['data'=>$agent,'paginate'=>$paginate], 'message' => trans('lang.Done')], 200);
    }

    //get one for agent by id
    public function show(Request $request)
    {
        $agent= new AgentResource($this->agentRepository->showData($request->id));//return one
        return response(['status' => 1, 'data' => $agent, 'message' => trans('lang.Done')], 200);
    }
}
