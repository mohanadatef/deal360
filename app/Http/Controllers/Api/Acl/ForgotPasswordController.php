<?php

namespace App\Http\Controllers\Api\Acl;

use App\Events\Api\Acl\EmailForgotPasswordEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Acl\ForgotPassword\ChangeRequest;
use App\Http\Resources\Acl\User\UserResource;
use App\Repositories\Acl\ForgotPasswordRepository;
use App\Traits\EmailMessageTrait;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    private $forgotpasswordrepository;
    use EmailMessageTrait;
    public function __construct(ForgotPasswordRepository $ForgotPasswordRepository)
    {
        $this->forgotpasswordrepository = $ForgotPasswordRepository;
    }

    public function search(Request $request)
    {
        $data = $this->forgotpasswordrepository->searchUser($request->email);
        if($data)
        {
            $code=$this->forgotpasswordrepository->code($data->id);
            event(new EmailForgotPasswordEvent($data,$this->passwordEmail($code)));
            return response(['status' => 1, 'data' => ['user'=>new UserResource($data)], 'message' => trans('lang.Done')], 200);
        }
        //if status not 1
        return response(['status' => 0, 'data' => array(), 'message' => trans('auth.support')], 200);
    }

    public function check(Request $request)
    {
       $data =  $this->forgotpasswordrepository->checkCode($request);
       if($data)
       {
           return response(['status' => 1, 'data' => [], 'message' => trans('lang.Done')], 200);
       }
        //if status not 1
        return response(['status' => 0, 'data' => array(), 'message' => trans('auth.code_wrong')], 200);
    }

    public function changePassowrd(ChangeRequest $request)
    {
        $this->forgotpasswordrepository->changePassword($request,$request->id);
        return response(['status' => 1, 'data' => [], 'message' => trans('lang.Done')], 200);
    }
}
