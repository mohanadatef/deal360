<?php

namespace App\Repositories\Admin\Acl;

use App\Interfaces\Admin\Acl\ForgotPasswordInterface;
use App\Models\Acl\ForgotPassword;
use Illuminate\Support\Str;

class ForgotPasswordRepository implements ForgotPasswordInterface
{
    protected $forgot_password;

    public function __construct(ForgotPassword $forgot_password)
    {
        $this->forgot_password = $forgot_password;
    }

    public function Store($id)
    {
        $data['status'] = 0;
        $data['user_id'] = $id;
        $data['code'] = Str::random(4);
        $this->forgot_password->create($data);
    }

    public function Check_User($id)
    {
       return $this->forgot_password->where('status', 0)->where('user_id', $id)->first();
    }

    public function Check_Code($id,$code)
    {
        return $this->forgot_password->where('status', 0)->where('user_id', $id)->where('code', $code)->first();
    }

    public function Update($id)
    {
        $data['status'] = 1;
        $this->forgot_password->find($id)->update($data);
    }
}
