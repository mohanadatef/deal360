<?php

namespace App\Http\Controllers\Admin\Acl;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Acl\User\CreateRequest;
use App\Http\Requests\Admin\Acl\User\EditRequest;
use App\Repositories\Admin\Acl\RoleRepository;
use App\Repositories\Admin\Acl\UserRepository;
use App\Repositories\Admin\CoreData\CountryRepository;

class UserController extends Controller
{
	private $userRepository;
	private $roleRepository;
	private $countryRepository;

	public function __construct(UserRepository $UserRepository,RoleRepository $RoleRepository,CountryRepository $CountryRepository)
	{
		$this->userRepository=$UserRepository;
		$this->roleRepository=$RoleRepository;
		$this->countryRepository=$CountryRepository;
		$this->middleware(['permission:user-list','permission:acl-list'])->except('listIndex');
		$this->middleware('permission:user-index')->only('index');
		$this->middleware('permission:user-create')->only('create','store');
		$this->middleware('permission:user-edit')->only('edit','update');
		$this->middleware('permission:user-status')->only('changeStatus');
		$this->middleware('permission:user-delete')->only('destroy');
		$this->middleware('permission:user-index-delete')->only('destroyIndex');
		$this->middleware('permission:user-restore')->only('restore');
		$this->middleware('permission:user-remove')->only('remove');
	}

	public function index()
	{
		$datas=$this->userRepository->getData();
		$paginator=['total_pages'=>ceil($datas->Total() / $datas->PerPage()),'current_page'=>$datas->CurrentPage(),
		            'url_page'   =>url('admin/user?page=')];
		return view(checkView('admin.acl.user.index'),compact('datas','paginator'));
	}

	public function create()
	{
		$role=$this->roleRepository->listData();
		$country=$this->countryRepository->listData();
		return view(checkView('admin.acl.user.create'),compact('role','country'));
	}

	public function store(CreateRequest $request)
	{
		$this->userRepository->storeData($request);
		return redirect(route('user.index'))->with(trans('lang.Done'));
	}

	public function edit($id)
	{
		$role=$this->roleRepository->listData();
		$data=$this->userRepository->showData($id);
		$country=$this->countryRepository->listData();
		return view(checkView('admin.acl.user.edit'),compact('data','role','country'));
	}

	public function update(EditRequest $request,$id)
	{
		$this->userRepository->updateData($request,$id);
		return redirect(route('user.index'))->with(trans('lang.Done'));
	}

	public function changeStatus($id)
	{
		$this->userRepository->updateStatusData($id);
	}

	public function destroy($id)
	{
		$this->userRepository->deleteData($id);
	}

	public function remove($id)
	{
		;
		$this->userRepository->removeData($id);
	}

	public function destroyIndex()
	{
		$datas=$this->userRepository->getDataDelete();
		$paginator=['total_pages'=>ceil($datas->Total() / $datas->PerPage()),'current_page'=>$datas->CurrentPage(),
		            'url_page'   =>url('admin/user?page=')];
		return view(checkView('admin.acl.user.destroy'),compact('datas','paginator'));
	}

	public function restore($id)
	{
		$this->userRepository->restoreData($id);
	}
}
