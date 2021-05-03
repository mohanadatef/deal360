<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\CallUs\CreateRequest;
use App\Http\Requests\Admin\Setting\CallUs\StatusEditRequest;
use App\Repositories\Admin\Setting\CallUsRepository;

class CallUsController extends Controller
{
    private $call_usRepository;

    public function __construct(CallUsRepository $Call_UsRepository)
    {
        $this->call_usRepository = $Call_UsRepository;
    }

    public function store(CreateRequest $request)
    {
        change_locale_language($request->language_id);
        $this->call_usRepository->Create_Data($request);
        return response(['status' => 1,'data'=>array(),'message'=>trans('lang.Message_Store')], 200);
    }

    public function unread()
    {
        $datas = $this->call_usRepository->Get_All_Unread_Data();
        return view('admin.setting.call_us.unread',compact('datas'));
    }

    public function read()
    {
        $datas = $this->call_usRepository->Get_All_Read_Data();
        return view('admin.setting.call_us.read',compact('datas'));
    }

    public function change_status($id)
    {
        $this->call_usRepository->Update_Status_One_Data($id);
        return redirect()->back()->with('message', trans('lang.Message_Status'));
    }

    public function change_many_status(StatusEditRequest $request)
    {
        $this->call_usRepository->Update_Status_Datas($request);
        return redirect()->back()->with('message', trans('lang.Message_Status'));
    }

    public function delete($id)
    {
        $this->call_usRepository->Delete_Data($id);
        return redirect()->back()->with('message', trans('lang.Message_Delete'));
    }
}
