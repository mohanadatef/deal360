<?php

namespace App\Interfaces\Admin\Acl;

use App\Http\Requests\Admin\Acl\Permission\CreateRequest;
use App\Http\Requests\Admin\Acl\Permission\EditRequest;


interface PermissionInterface{

    public function getData();
    public function storeData(CreateRequest $request);
    public function Get_One_Data($id);
    public function updateData(EditRequest $request, $id);
    public function Get_listData();
}
