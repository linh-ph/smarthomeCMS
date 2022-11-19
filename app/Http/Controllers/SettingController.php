<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Features;
use App\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::all();
        return view('Setting.ds_setting', compact('settings'));
    }

    public function update(Request $request, $id)
    {
        $setting = Setting::find($id);
        if (!isset($setting)) {
            return redirect('setting')->with('error', 'Không tìm thấy setting!');
        } else {
            $setting->log = $request->log;
            $setting->muc_canh_bao = $request->muc_canh_bao;
            $setting->trang_thai = $request->trang_thai;
            $setting->save();
            return redirect('setting')->with('success', 'Cập nhật thành công!');
        }
    }
}
