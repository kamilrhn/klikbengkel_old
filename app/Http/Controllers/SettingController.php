<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\Area;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    //
    public function index($kode_area)
    {
        Auth::user();
        $area = Area::find($kode_area);
        $setting = Settings::find($kode_area);

        return view('settings.index', compact('setting', 'area'));
    }

    public function create(Request $request)
    {
        Auth::user();
        $setting = new Settings();
        $setting->kode_area = Auth::user()->resp;
        $setting->km = $request->km;
        $setting->waktu = $request->waktu;
        $setting->save();

        return redirect()->back();
    }
}
