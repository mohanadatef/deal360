<?php

namespace App\Repositories\Admin\Setting;

use App\Http\Requests\Admin\Setting\CallUs\CreateRequest;
use App\Http\Requests\Admin\Setting\CallUs\StatusEditRequest;
use App\Interfaces\Admin\Setting\CallUsInterface;
use App\Models\Setting\CallUs;
use App\Traits\Service;
use Illuminate\Http\Request;

class CallUsRepository implements CallUsInterface
{
    use Service;
    protected $call_us;

    public function __construct(CallUs $call_us)
    {
        $this->call_us = $call_us;
    }

    public function Get_All_Unread_Data()
    {
        return $this->call_us->status(0)->get();
    }

    public function Get_All_Read_Data()
    {
        return $this->call_us->status(1)->get();
    }

    public function Create_Data(CreateRequest $request)
    {
        $data['status']=0;
        $this->call_us->create(array_merge($request->all(),$data));
    }

    public function Get_One_Data($id)
    {
        return $this->call_us->findorFail($id);
    }

    public function Update_Status_One_Data($id)
    {
        $this->change_status($this->Get_One_Data($id));
    }

    public function Get_Many_Data(Request $request)
    {
        return $this->call_us->wherein('id', $request->change_status)->get();
    }

    public function Update_Status_Datas(StatusEditRequest $request)
    {
        $this->change_status($this->Get_Many_Data($request));
    }

    public function Delete_Data($id)
    {
        $this->call_us->findorFail($id)->delete();
    }
}
