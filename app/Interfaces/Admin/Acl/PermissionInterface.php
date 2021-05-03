<?php

namespace App\Interfaces\Admin\Acl;

use App\Http\Requests\Admin\Acl\Permission\CreateRequest;
use App\Http\Requests\Admin\Acl\Permission\EditRequest;


interface PermissionInterface{

    public function Get_All_Data();
    public function Create_Data(CreateRequest $request);
    public function Get_One_Data($id);
    public function Update_Data(EditRequest $request, $id);
    public function Get_List_Data();
}
