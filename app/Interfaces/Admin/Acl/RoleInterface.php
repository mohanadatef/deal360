<?php

namespace App\Interfaces\Admin\Acl;

use App\Http\Requests\Admin\Acl\Role\CreateRequest;
use App\Http\Requests\Admin\Acl\Role\EditRequest;


interface RoleInterface{

    public function Get_All_Data();
    public function Create_Data(CreateRequest $request);
    public function Get_One_Data($id);
    public function Update_Data(EditRequest $request, $id);
    public function Get_List_Data();
    public function Get_Permission_For_Role($id);
    public function Get_List_Register();
}
