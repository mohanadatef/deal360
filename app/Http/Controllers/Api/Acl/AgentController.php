<?php

namespace App\Http\Controllers\Api\Acl;

use App\Events\Api\Setting\ViewEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\Acl\Agent\AgentCardResource;
use App\Http\Resources\Acl\Agent\AgentResource;
use App\Http\Resources\Acl\Agent\AgentPropertyResource;
use App\Http\Resources\Acl\Company\CompanyPropertyResource;
use App\Models\Acl\User;
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
        $request->request->add(['web' => 1]);
        $agent = $this->agentRepository->getData($request);
        $paginate = ['total_pages' => ceil($agent->Total() / $agent->PerPage()), 'current_page' => $agent->CurrentPage(), 'url_page' => url('admin/agent?page=')];
        $agent = AgentCardResource::collection($agent);
        return response(['status' => 1, 'data' => ['agent' => $agent, 'paginate' => $paginate], 'message' => trans('lang.Done')], 200);
    }

    //get one for agent by id
    public function show(Request $request)
    {
        if ($request->property==1){
            $agent = new AgentPropertyResource($this->agentRepository->propertyData($request->id));//return one
        }else{
            $agent = new AgentResource($this->agentRepository->showData($request->id));//return one
        }

        if (isset($request->auth_id) && !empty($request->auth_id)) {
            event(new ViewEvent($agent->userid, User::class, $request->ip(), $request->auth_id));
        }
        return response(['status' => 1, 'data' => $agent, 'message' => trans('lang.Done')], 200);
    }
}
