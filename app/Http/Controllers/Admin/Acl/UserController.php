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

    public function __construct(UserRepository $UserRepository,RoleRepository $RoleRepository,
                                CountryRepository $CountryRepository)
    {
        $this->userRepository = $UserRepository;
        $this->roleRepository = $RoleRepository;
        $this->countryRepository = $CountryRepository;
    }

    public function index()
    {
        $datas = $this->userRepository->getData();
        return view(checkView('admin.acl.user.index'),compact('datas'));
    }

    public function create()
    {
        $role = $this->roleRepository->listData();
        $country = $this->countryRepository->listData();
        return view(checkView('admin.acl.user.create'),compact('role','country'));
    }

    public function store(CreateRequest $request)
    {
        $this->userRepository->storeData($request);
        return redirect(route('user.index'))->with(trans('Done'));
    }

    public function edit($id)
    {
        $role = $this->roleRepository->listData();
        $data = $this->userRepository->showData($id);
        return view(checkView('admin.acl.user.edit'),compact('data','role'));
    }

    public function update(EditRequest $request, $id)
    {
        $this->userRepository->updateData($request, $id);
        return redirect(route('user.index'))->with(trans('Done'));
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
    {;
        $this->userRepository->removeData($id);
    }

    public function destroyIndex()
    {
        $datas = $this->userRepository->getDataDelete();
        return view(checkView('admin.acl.user.destroy'), compact('datas'));
    }

    public function restore($id)
    {
        $this->userRepository->restoreData($id);
    }

    public function listIndex()
    {
        return $this->userRepository->listData();
    }
}
