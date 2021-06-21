<?php

namespace App\Http\Controllers\Admin\Acl;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Acl\Agent\CreateRequest;
use App\Http\Requests\Admin\Acl\Agent\EditRequest;
use App\Repositories\Acl\AgentRepository;
use App\Repositories\Acl\CompanyRepository;
use App\Repositories\CoreData\CountryRepository;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    private $agentRepository;
    private $countryRepository;
    private $companyRepository;

    public function __construct(AgentRepository $AgentRepository,CountryRepository $CountryRepository,
	    CompanyRepository $CompanyRepository)
    {
        $this->agentRepository = $AgentRepository;
        $this->countryRepository = $CountryRepository;
        $this->companyRepository = $CompanyRepository;
        $this->middleware(['permission:agent-list', 'permission:acl-list'])->except('listIndex');
        $this->middleware('permission:agent-index')->only('index');
        $this->middleware('permission:agent-create')->only('create', 'store');
        $this->middleware('permission:agent-edit')->only('edit', 'update');
        $this->middleware('permission:agent-status')->only('changeStatus');
        $this->middleware('permission:agent-delete')->only('destroy');
        $this->middleware('permission:agent-index-delete')->only('destroyIndex');
        $this->middleware('permission:agent-restore')->only('restore');
        $this->middleware('permission:agent-remove')->only('remove');
    }

    public function index(Request $request)
    {
        $datas = $this->agentRepository->getData($request);
        $paginator = ['total_pages' => ceil($datas->Total() / $datas->PerPage()),
            'current_page' => $datas->CurrentPage(),
            'url_page' => url('admin/agent?page=')];
        return view(checkView('admin.acl.agent.index'), compact('datas', 'paginator'));
    }

    public function create()
    {
        $country = $this->countryRepository->listData();
        $company = $this->companyRepository->listData();
        return view(checkView('admin.acl.agent.create'), compact( 'country','company'));
    }

    public function store(CreateRequest $request)
    {
        $this->agentRepository->storeData($request);
        return redirect(route('agent.index'))->with(trans('Done'));
    }

    public function edit($id)
    {
        $data = $this->agentRepository->showData($id);
	    $country = $this->countryRepository->listData();
	    $company = $this->companyRepository->listData();
	    return view(checkView('admin.acl.agent.edit'), compact('data',  'country','company'));
    }

    public function update(EditRequest $request, $id)
    {
        $this->agentRepository->updateData($request, $id);
        return redirect(route('agent.index'))->with(trans('Done'));
    }

    public function changeStatus($id)
    {
        $this->agentRepository->updateStatusData($id);
    }

	public function changeApprove($id)
	{
		$this->agentRepository->updateApproveData($id);
	}

    public function destroy($id)
    {
        $this->agentRepository->deleteData($id);
    }

    public function remove($id)
    {
        ;
        $this->agentRepository->removeData($id);
    }

    public function destroyIndex()
    {
        $datas = $this->agentRepository->getDataDelete();
        $paginator = ['total_pages' => ceil($datas->Total() / $datas->PerPage()),
            'current_page' => $datas->CurrentPage(),
            'url_page' => url('admin/agent?page=')];
        return view(checkView('admin.acl.agent.destroy'), compact('datas','paginator'));
    }

    public function restore($id)
    {
        $this->agentRepository->restoreData($id);
    }

	public function listIndex()
	{
		return $this->agentRepository->listData();
	}
}
