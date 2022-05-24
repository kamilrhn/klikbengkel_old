<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Kendaraan;
use App\Models\Service;
use App\Models\ServiceDetail;
use App\Models\ReleaseBudget;
use App\Models\Settings;
use Carbon\Carbon;

class DashboardController extends Controller
{
    //
    public function _construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        Auth::user();
        $service = Service::orderBy('tanggal', 'desc')->take(10)->get();
        $kode_area = 0;
        // dd($budgetNow);
        $budget = ReleaseBudget::whereMonth('bulan', Carbon::now()->month)->get();
        $budget_awal = $budget->sum('budget_awal');
        $sisa_budget = $budget->sum('sisa_budget');
        $rincian = ServiceDetail::whereHas('service')->distinct('keterangan')->get('keterangan');
        $getService = Service::all();
        $totalsps = $getService->whereNotNull('status')->where('status', '!=', 'Decline')->where('status', '!=', 'Cancel')->count();
        $serviceOngoing = $getService->where('status', 'On Service')->count();
        $serviceOnwarran = $getService->where('status', 'On Warranty')->count();
        $serviceDone = $getService->where('status', 'Paid')->count();
        $spsdone = $serviceOnwarran + $serviceDone;
        $kendaraan = Kendaraan::count();
        $platb = Kendaraan::where('status_nopol', 'PLAT B')->count();
        $pplatb = 0;
        if($kendaraan != 0){
            $pplatb = $platb/$kendaraan*100;
        }else{
            $pplatb = 0;
        }

        $lokal = Kendaraan::where('status_nopol', 'LOKAL')->count();
        $plokal = 0;
        if($kendaraan != 0){
            $plokal = $lokal/$kendaraan*100;
        }else{
            $plokal = 0;
        }
        
        return view('home.dashboard', compact('kendaraan', 'platb', 'pplatb', 'lokal', 'plokal', 'service'
                    , 'serviceOngoing', 'serviceOnwarran', 'serviceDone', 'rincian', 'kode_area', 'budget', 'budget_awal', 'sisa_budget', 'totalsps', 'spsdone'));
    }

    public function dashboardArea($kode_area)
    {
        Auth::user();
        $budget = ReleaseBudget::where('kode_area', $kode_area)->whereMonth('bulan', Carbon::now()->month)->get();
        $budget_awal = $budget->sum('budget_awal');
        $sisa_budget = $budget->sum('sisa_budget');
        $service = Service::where('area', $kode_area)->where('status', '!=', 'NULL')->orderBy('created_at', 'desc')->take(5)->get();
        $rincian = ServiceDetail::whereHas('service', function($q) use($kode_area){
            $q->where('service.area', $kode_area)->where('service.status', '!=', 'Decline');
        })->distinct('keterangan')->get('keterangan');
        $getService = Service::where('area', $kode_area)->get();
        $totalsps = $getService->whereNotNull('status')->where('status', '!=', 'Decline')->where('status', '!=', 'Cancel')->count();
        
        $serviceOngoing = $getService->where('status', 'On Service')->count();
        $serviceOnwarran = $getService->where('status', 'On Warranty')->count();
        $serviceDone = $getService->where('status', 'Paid')->count();
        $spsdone = $serviceOnwarran + $serviceDone;

        $kendaraanArea = Kendaraan::where('area', $kode_area)->get();
        // dd($kendaraanArea);
        $kendaraan = Kendaraan::where('area', $kode_area)->count();
        $platb = $kendaraanArea->where('status_nopol', 'PLAT B')->count();
        $pplatb = 0;
        if($kendaraan != 0){
            $pplatb = $platb/$kendaraan*100;
        }else{
            $pplatb = 0;
        }

        $lokal = $kendaraanArea->where('status_nopol', 'LOKAL')->count();
        $plokal = 0;
        if($kendaraan != 0){
            $plokal = $lokal/$kendaraan*100;
        }else{
            $plokal = 0;
        }
        
        return view('home.dashboard', compact('kendaraan', 'platb', 'pplatb', 'lokal', 'plokal', 'service'
                    ,'serviceOngoing', 'serviceOnwarran', 'serviceDone', 'rincian', 'budget', 'budget_awal', 'sisa_budget', 'totalsps', 'spsdone'));
    }

    public function dashboardPool($pool)
    {
        Auth::user();
        $kendaraan = Kendaraan::all();
        $kendaraanPool = Kendaraan::where('pool', $pool)->get();
        $service = Service::where('pool', $pool)->where('status', '!=', 'NULL')->take(5)->get();
        $rincian = ServiceDetail::whereHas('service', function($q) use($pool){
            $q->where('service.pool', $pool)->where('service.status', '!=', 'Decline');
        })->distinct('keterangan')->get('keterangan');
        $getService = Service::where('pool', $pool)->get();
        $serviceOngoing = $getService->where('status', 'On Service')->count();
        $serviceOnwarran = $getService->where('status', 'On Warranty')->count();
        $serviceDone = $getService->where('status', 'Paid')->count();
         $totalsps = $getService->whereNotNull('status')->where('status', '!=', 'Decline')->where('status', '!=', 'Cancel')->count();
        $spsdone = $serviceOnwarran + $serviceDone;

        $kendaraan = Kendaraan::where('pool', $pool)->count();
        $platb = $kendaraanPool->where('status_nopol', 'PLAT B')->count();
        $pplatb = 0;
        if($kendaraan != 0){
            $pplatb = $platb/$kendaraan*100;
        }else{
            $pplatb = 0;
        }

        $lokal = $kendaraanPool->where('status_nopol', 'LOKAL')->count();
        $plokal = 0;
        if($kendaraan != 0){
            $plokal = $lokal/$kendaraan*100;
        }else{
            $plokal = 0;
        }
        
        return view('home.dashboard', compact('kendaraan', 'platb', 'pplatb', 'lokal', 'plokal', 'service'
                    ,'serviceOngoing', 'serviceOnwarran', 'serviceDone', 'rincian', 'totalsps', 'spsdone'));
    }

   public function cariPart(Request $request)
   {
        $search = $request->input('search');
        if(Auth::user()->isDispatcher()){
            $service = Service::where('pool', Auth::user()->resp)->where('status', '!=','Decline')->whereHas('rincian', function($q) use($search){
                $q->where('rincian_service.keterangan', $search);
            })->get();
        }elseif(Auth::user()->isAsman()){
            $service = Service::where('area', Auth::user()->resp)->where('status', '!=','Decline')->whereHas('rincian', function($q) use($search){
                $q->where('rincian_service.keterangan', $search);
            })->get();
        }else{
            $service = Service::where('status', '!=','Decline')->whereHas('rincian', function($q) use($search){
                $q->where('rincian_service.keterangan', $search);
            })->get();
        }
        return view('home.cari', compact('search','service'));
   }

   public function cariDetail($no_service){
       Auth::user();
       $service = Service::find($no_service);
        $kendaraan = Kendaraan::find($service->nopol);
        
        $rincian = ServiceDetail::where('no_service', $no_service)->get();
        $rinciankhs = ServiceDetail::where('no_service', $no_service)->where('kategori', 'khs')->get();
        $totalkhs = $rinciankhs->sum('subtotal');
        $rinciannon = ServiceDetail::where('no_service', $no_service)->where('kategori', 'non')->get();
        $totalnon = $rinciannon->sum('subtotal');
        $setting = Settings::find($service->area);
       return view('home.detail', compact('kendaraan', 'service',  'rincian', 'setting', 'rinciankhs', 'rinciannon', 'totalkhs', 'totalnon'));
   }
}
