<?php

namespace App\Http\Controllers\Admin\Acl;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Acl\User\CreateRequest;
use App\Http\Requests\Admin\Acl\User\EditRequest;
use App\Http\Requests\Admin\Acl\User\StatusEditRequest;
use App\Http\Requests\Admin\Acl\User\PasswordRequest;
use App\Repositories\Admin\Acl\RoleRepository;
use App\Repositories\Admin\Acl\UserRepository;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $userRepository;
    private $roleRepository;

    public function __construct(UserRepository $UserRepository,RoleRepository $RoleRepository)
    {
        $this->userRepository = $UserRepository;
        $this->roleRepository = $RoleRepository;
    }

    public function index()
    {
        $datas = $this->userRepository->Get_All_Data();
        return view('admin.acl.user.index',compact('datas'));
    }

    public function create()
    {
        $role = $this->roleRepository->Get_List_Data();
        return view('admin.acl.user.create',compact('role'));
    }

    public function store(CreateRequest $request)
    {
        $this->userRepository->Create_Data($request);
        return Auth::user() ? redirect('/admin/user/index')->with('message', trans('lang.Message_Store')) : redirect('login')->with('message', trans('lang.Message_Store'));
    }

    public function edit($id)
    {
        $role = $this->roleRepository->Get_List_Data();
        $data = $this->userRepository->Get_One_Data($id);
        return view('admin.acl.user.edit',compact('data','role'));
    }

    public function update(EditRequest $request, $id)
    {
        $this->userRepository->Update_Data($request, $id);
        if(auth::user()->role_id == 4)
        {
            return redirect('admin')->with('message', trans('lang.Message_Edit'));
        }
        return redirect('/admin/user/index')->with('message', trans('lang.Message_Edit'));
    }

    public function resat_password($id)
    {
        $this->userRepository->Resat_Password($id);
        return redirect()->back()->with('message', trans('lang.Message_Edit'));
    }

    public function password()
    {
        return view('admin.acl.user.password');
    }

    public function change_password(PasswordRequest $request, $id)
    {
        $this->userRepository->Update_Password_Data($request, $id);
        return redirect('/admin')->with('message',trans('passwords.reset'));
    }

    public function change_status($id)
    {
        $this->userRepository->Update_Status_One_Data($id);
       return redirect()->back()->with('message', trans('lang.Message_Status'));
    }

    public function change_many_status(StatusEditRequest $request)
    {
        $this->userRepository->Update_Status_Data($request);
       return redirect()->back()->with('message', trans('lang.Message_Status'));
    }

    public function register()
    {
        $role = $this->roleRepository->Get_List_Register();
        return view('auth.register',compact('role'));
    }
}
