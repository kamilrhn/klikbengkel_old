<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use DateTime;
use DateTimeZone;
use App\Models\Kendaraan;
use App\Models\Area;
use App\Models\Pool;
use App\Models\Bengkel;
use App\Models\Service;
use App\Models\ServiceDetail;
use App\Models\StokService;
use App\Models\RincianStokService;
use App\Models\StokSparepart;
use Carbon\Carbon;

class ReminderController extends Controller
{
    //
    public function index($pool){
        Auth::user();
        $kendaraan = Kendaraan::where('pool', $pool)->whereNotNull('last_service')->get();
        
        // dd($kendaraan);
        foreach($kendaraan as $k){
            $last = Carbon::createFromFormat('Y-m-d', $k->last_service)->addMonth(2);
        }
       
        return view('reminder.index', compact('kendaraan', 'last'));
    }
}
