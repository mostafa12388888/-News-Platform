<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\SettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    public function index()
    {
        return view('Admin.Setting.index');
    }
    public function update(SettingRequest $request)
    {
        $setting = Setting::findOrFail($request->settingId);

        if ($request->hasFile('logo')) {
            $logo = FileHelper::uploadFile($request->logo, 'Setting');
            FileHelper::deleteFile($setting->logo);
        }
        if ($request->hasFile('favicon')) {
            $favicon = FileHelper::uploadFile($request->favicon, 'Setting');
            FileHelper::deleteFile($setting->favicon);
        }
        $setting->update([
            'site_name' => $request->site_name,
            'logo' => $logo??$setting->logo,
            'favicon' => $favicon??$setting->favicon,
            'instagram' => $request->instagram,
            'twitter' => $request->twitter,
            'youtube' => $request->youtube,
            'facebook' => $request->facebook,
            'street' => $request->street,
            'city' => $request->city,
            'country' => $request->country,
            'email' => $request->email,
            'phone' => $request->phone
        ]);
        Session::flash('success', 'update Setting Successfully');
        return redirect()->back();
    }
}
