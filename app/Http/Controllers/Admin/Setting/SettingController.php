<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\Setting\CreateRequest;
use App\Http\Requests\Admin\Setting\Setting\EditRequest;
use App\Http\Resources\Admin\Setting\SettingResource;
use App\Repositories\Admin\Setting\SettingRepository;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    private $settingRepository;

    public function __construct(SettingRepository $SettingRepository)
    {
        $this->settingRepository = $SettingRepository;
    }

    public function index()
    {
        $datas = $this->settingRepository->getAllData();
        return view('admin.setting.setting.index',compact('datas'));
    }

    public function create()
    {
        return view('admin.setting.setting.create');
    }

    public function store(CreateRequest $request)
    {
        $this->settingRepository->storeData($request);
        return redirect('/admin/setting/index')->with('message', trans('lang.Message_Store'));
    }

    public function edit($id)
    {
        $data = $this->settingRepository->Get_One_Data_Translation($id);
        return view('admin.setting.setting.edit',compact('data'));
    }

    public function update(EditRequest $request, $id)
    {
        $this->settingRepository->updateData($request, $id);
        return redirect('/admin/setting/index')->with('message', trans('lang.Message_Edit'));
    }

    public function show_api(Request $request)
    {
        changeLocaleLanguage($request->language_id);
        return response(['status' => 1, 'data' => ['setting'=> new SettingResource($this->settingRepository->getAllData()->first())], 'message' => trans('lang.Index')], 206);
    }

    public function show()
    {
        $data = $this->settingRepository->getAllData()->first();
        return view('frontend.setting',compact('data'));
    }
}
