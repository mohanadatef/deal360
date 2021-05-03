<?php

namespace App\Interfaces\Admin\Setting;


use App\Http\Requests\Admin\Setting\CallUs\CreateRequest;
use App\Http\Requests\Admin\Setting\CallUs\StatusEditRequest;
use Illuminate\Http\Request;

interface CallUsInterface{

    public function Get_All_Unread_Data();
    public function Get_All_Read_Data();
    public function Create_Data(CreateRequest $request);
    public function Update_Status_One_Data($id);
    public function Get_Many_Data(Request $request);
    public function Update_Status_Datas(StatusEditRequest $request);
    public function Delete_Data($id);
}
