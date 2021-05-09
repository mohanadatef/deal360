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

    public function getData()
    {
        return $this->user->order('asc')->all();
    }

    public function storeData(CreateRequest $request)
    {
        $data['status'] = 1;
        Auth::user() ? $data['status_login'] = 0 : $data['status_login'] = 1;
        $data['password'] = Hash::make($request->password);
        if ($request->image) {
            $data['image']= $this->uploadImage($request->image,'user');
        }
        return $this->user->create(array_merge($request->all(), $data));
    }


    public function Get_One_Data($id)
    {
        return $this->user->findorFail($id);
    }

    public function updateData(EditRequest $request, $id)
    {
        if ($request->image != null) {
            $data['image']= $this->uploadImage($request->image,'user');
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
        $this->changeStatus($this->Get_One_Data($id));
    }

    public function Get_Many_Data(Request $request)
    {
        return $this->user->wherein('id', $request->changeStatus)->get();
    }

    public function updateStatusData(StatusEditRequest $request)
    {
        $this->changeStatus($this->Get_Many_Data($request));
    }
}
