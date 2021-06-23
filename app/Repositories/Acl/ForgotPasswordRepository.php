<?php

namespace App\Repositories\Acl;

use App\Interfaces\Acl\ForgotPasswordInterface;
use App\Models\Acl\ForgotPassword;
use App\Models\Acl\User;
use App\Traits\ServiceDataTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ForgotPasswordRepository implements ForgotPasswordInterface
{
    protected $data,$forgotpassword;
    protected $userRepository;
use ServiceDataTrait;
    public function __construct(User $User,UserRepository $UserRepository,ForgotPassword $ForgotPassword)
    {
        $this->data = $User;
        $this->forgotpassword = $ForgotPassword;
        $this->userRepository = $UserRepository;
    }

    public function changePassword($request,$id)
    {
        $data = $this->userRepository->showData($id);
        $data['password'] = Hash::make($request->password);
        $data->update($data->toArray());
    }

    public function searchUser($email)
    {
        return $this->userRepository->searchData($email);
    }

    public function code($id)
    {
        $data = $this->searchCode($id);
        $code= !$data?$this->forgotpassword->create(['code'=>Str::random(5),'user_id'=>$id]):$data;
        return $code->code;
    }

    public function searchCode($id)
    {
        return $this->forgotpassword->where('user_id',$id)->status(0)->first();
    }

    public function checkCode($request)
    {
       $data =  $this->forgotpassword->where('user_id',$request->id)->status(0)->where('code',$request->code)->first();
       if($data)
       {
           $this->changeStatus($data);
           return true;
       }
        return false;
    }
}
