<?php

namespace App\Interfaces\Admin\Acl;

use App\Http\Requests\Admin\Acl\User\CreateRequest;
use App\Http\Requests\Admin\Acl\User\EditRequest;
use App\Http\Requests\Admin\Acl\User\PasswordRequest;
use App\Http\Requests\Admin\Acl\User\StatusEditRequest;
use Illuminate\Http\Request;


interface UserInterface{
    public function Get_All_Data();
    public function Create_Data(CreateRequest $request);
    public function Get_One_Data($id);
    public function Resat_Password($id);
    public function Update_Data(EditRequest $request, $id);
    public function Update_Password_Data(PasswordRequest $request, $id);
    public function Update_Status_One_Data($id);
    public function Get_Many_Data(Request $request);
    public function Update_Status_Data(StatusEditRequest $request);
}
