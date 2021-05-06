<?php

namespace App\Interfaces\Admin\Setting;

use App\Http\Requests\Admin\Setting\Setting\CreateRequest;
use App\Http\Requests\Admin\Setting\Setting\EditRequest;

interface SettingInterface{

    public function getAllData();
    public function storeData(CreateRequest $request);
    public function Get_One_Data($id);
    public function updateData(EditRequest  $request, $id);
}
