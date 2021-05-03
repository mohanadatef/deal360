<?php

namespace App\Repositories\Admin\Acl;


use App\Http\Requests\Admin\Acl\User\CreateRequest;
use App\Http\Requests\Admin\Acl\User\EditRequest;
use App\Http\Requests\Admin\Acl\User\PasswordRequest;
use App\Http\Requests\Admin\Acl\User\StatusEditRequest;
use App\Interfaces\Admin\Acl\UserInterface;
use App\Models\Acl\User;
use App\Traits\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterface
{
    use Service;
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function Get_All_Data()
    {
        return $this->user->order('asc')->all();
    }

    public function Create_Data(CreateRequest $request)
    {
        $data['status'] = 1;
        Auth::user() ? $data['status_login'] = 0 : $data['status_login'] = 1;
        $data['password'] = Hash::make($request->password);
        if ($request->image) {
            $data['image']= $this->image_upload($request->image,'user');
        }
        return $this->user->create(array_merge($request->all(), $data));
    }


    public function Get_One_Data($id)
    {
        return $this->user->findorFail($id);
    }

    public function Update_Data(EditRequest $request, $id)
    {
        if ($request->image != null) {
            $data['image']= $this->image_upload($request->image,'user');
            return $this->Get_One_Data($id)->update(array_merge($request->all(), $data));
        } else return $this->Get_One_Data($id)->update($request->all());
    }

    public function Resat_Password($id)
    {
        $user = $this->Get_One_Data($id);
        $user->password = Hash::make('123456');
        $user->update();
    }

    public function Update_Password_Data(PasswordRequest $request, $id)
    {
        $user = $this->Get_One_Data($id);
        $user->password = Hash::make($request->password);
        $user->update();
    }

    public function Update_Status_One_Data($id)
    {
        $this->change_status($this->Get_One_Data($id));
    }

    public function Get_Many_Data(Request $request)
    {
        return $this->user->wherein('id', $request->change_status)->get();
    }

    public function Update_Status_Data(StatusEditRequest $request)
    {
        $this->change_status($this->Get_Many_Data($request));
    }
}
