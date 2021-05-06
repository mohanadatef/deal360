<?php

namespace App\Http\Controllers\Admin\Acl;

use App\Http\Requests\Admin\Acl\User\PasswordRequest;
use App\Repositories\Admin\Acl\ForgotPasswordRepository;
use App\Repositories\Admin\Acl\PatientRepository;
use App\Repositories\Admin\Acl\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    private $userRepository;
    private $forgotpasswordRepository;

    public function __construct(UserRepository $UserRepository, ForgotPasswordRepository $ForgotPasswordRepository)
    {
        $this->userRepository = $UserRepository;
        $this->forgotpasswordRepository = $ForgotPasswordRepository;
    }

    public function index()
    {
        return view('auth.forgot_password.check');
    }

    public function check(Request $request)
    {
        $request->language_id ? changeLocaleLanguage($request->language_id) : true;
        $user = $this->userRepository->Check_User($request->email);
        if ($user['status_data'] == 0) {
            return $request->language_id ? response(['status' => $user['status_data'], 'data' => $user['user'], 'message' => $user['message']], $user['status']) : redirect()->back()->with('message_fales', $user['message']);
        }
        $forgot_password = $this->forgotpasswordRepository->Check_User($user['user']['id']);
        if (!$forgot_password) {
            $this->forgotpasswordRepository->Store($user['user']['id']);
        }
        return $request->language_id ? response(['status' => $user['status_data'], 'data' => array(), 'message' => trans('lang.Send_Mail')], $user['status']) : view('auth.forgot_password.validate_code');
    }

    public function validate_code(Request $request)
    {
        $request->language_id ? changeLocaleLanguage($request->language_id) : true;
        $user = $this->userRepository->Check_User($request->email);
        if ($user['status_data'] == 0) {
            return $request->language_id ? response(['status' => $user['status_data'], 'data' => $user['user'], 'message' => $user['message']], $user['status']) : redirect()->back()->with('message_fales', $user['message']);
        }
        $forgot_password = $this->forgotpasswordRepository->Check_Code($user['user']['id'], $request->code);
        if ($forgot_password) {
            $this->forgotpasswordRepository->Update($forgot_password->id);
            !$request->language_id ? $this->userRepository->Resat_Password($user['user']['id']) : true;
            if ($request->language_id) {
                return response(['status' => $user['status_data'], 'data' => array(), 'message' => trans('lang.Message_Edit')], $user['status']);
            } else {
                Auth::login($user['user']);
                return redirect('admin');
            }
        }
        return $request->language_id ? response(['status' => 0, 'data' => array(), 'message' => trans('lang.Message_Code_Wong')], $user['status']) : redirect()->back()->with('message_fales', trans('lang.Message_Code_Wong'));
    }


    public function change_password(PasswordRequest $request)
    {
        changeLocaleLanguage($request->language_id);
        $user = $this->userRepository->Check_User($request->email);
        if ($user['status_data'] == 0) {
            return response(['status' => $user['status_data'], 'data' => $user['user'], 'message' => $user['message']], $user['status']);
        }
        $this->userRepository->Update_Password_Data($request, $user['user']['id']);
        return response(['status' => $user['status_data'], 'data' => array(), 'message' => trans('lang.Message_Edit')], $user['status']);
    }
}
