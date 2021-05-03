<?php

namespace App\Repositories\Admin\Setting;

use App\Http\Requests\Admin\Setting\Setting\CreateRequest;
use App\Http\Requests\Admin\Setting\Setting\EditRequest;
use App\Interfaces\Admin\Setting\SettingInterface;
use App\Models\Setting\Setting;

class SettingRepository implements SettingInterface
{

    protected $setting;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    public function Get_All_Data()
    {
        return $this->setting->all();
    }

    public function Create_Data(CreateRequest $request)
    {
        $logoName = $request->logo->getClientOriginalname() . '-' . time() . '-logo.' . Request()->logo->getClientOriginalExtension();
        Request()->logo->move(public_path('images/setting'), $logoName);
        $data['logo'] = $logoName;
        $this->setting->create(array_merge($request->all(), $data));
    }

    public function Get_One_Data($id)
    {
        return $this->setting->find($id);
    }

    public function Update_Data(EditRequest $request, $id)
    {
        if ($request->logo != null) {
            $logoName = $request->logo->getClientOriginalname() . '-' . time() . '-logo.' . Request()->logo->getClientOriginalExtension();
            Request()->logo->move(public_path('images/setting'), $logoName);
            $data['logo'] = $logoName;
            $this->Get_One_Data($id)->update(array_merge($request->all(), $data));
        } else $this->Get_One_Data($id)->update($request->all());
    }
}
