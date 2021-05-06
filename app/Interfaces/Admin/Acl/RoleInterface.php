<?php

namespace App\Interfaces\Admin\Acl;

use App\Http\Requests\Admin\Acl\Role\CreateRequest;
use App\Http\Requests\Admin\Acl\Role\EditRequest;


interface RoleInterface{

    public function getAllData();
    public function storeData(CreateRequest $request);
    public function Get_One_Data($id);
    public function updateData(EditRequest $request, $id);
    public function Get_listData();
    public function Get_Permission_For_Role($id);
    public function Get_List_Register();
}
