<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use DateTime;
use DateTimeZone;
use App\Models\ReleaseBudget;
use App\Models\DistribusiBudget;
use App\Models\TopupBudget;
use App\Models\Area;
use App\Models\Pool;
use App\Models\Witel;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class BudgetController extends Controller
{
    //
    public function releaseBudget()
    {
        Auth::user();
        $budget = ReleaseBudget::get();
        $area = Area::whereDoesntHave('budget')->get();
        return view('budget.release', compact('budget', 'area'));
    }

    public function storeRelease(Request $request)
    {
        Auth::user();
        $timezone = 'Asia/Jakarta';
        $date = new DateTime('now', new DateTimeZone($timezone));
        $format = $date->format('ym');
        $kode_area = $request->kode_area;
        
        $tanggal = $date->format('Y-m-d');

        $budget = new ReleaseBudget();
        $budget->kode = $kode_area.$format; 
        $budget->kode_area = $kode_area;
        $budget->bulan = $tanggal;
        $budget->budget_awal = $request->budget;
        $budget->sisa_budget = $request->budget;
        
        if($request->budget != null){
            $budget->save();
            Alert::success('Berhasil', 'Anda telah berhasil menambahkan release budget');
            return redirect()->back();
        }else{
            Alert::error('Gagal', 'Anda belum input nominal release budget');
            return redirect()->back();
        }
    }

    public function distribusiBudget($kode_area)
    {
        Auth::user();
        
        $pool = Pool::where('kode_area', $kode_area)->whereDoesntHave('distribusi')->get();
        
        $budget = DistribusiBudget::where('kode_area', $kode_area)->get();
        return view('budget.distribusi', compact('budget', 'pool'));
    }

    public function storeDistribusi(Request $request, $kode_area)
    {
        Auth::user();
        $this->validate($request,[
            'pool' => 'required'
        ]);
        $timezone = 'Asia/Jakarta';
        $date = new DateTime('now', new DateTimeZone($timezone));
        $format = $date->format('ym');
        $kode = $request->pool.$format;
        $pool = Pool::find($request->pool);
        
        $tanggal = $date->format('Y-m-d');

        $budget = new DistribusiBudget();
        $budget->kode = $kode;
        $budget->kode_release =  $kode_area.$format;
        $budget->kode_area = $kode_area;
        $budget->witel = $pool->witel;
        $budget->pool = $request->pool;
        $budget->bulan = $tanggal;
        $budget->budget_awal = $request->budget;
        $budget->sisa_budget = $request->budget;
        $release = ReleaseBudget::find($kode_area.$format);
        $saldo_before = $release->sisa_budget;
        if($request->budget <= $saldo_before){
            $saldo_after = $saldo_before - $request->budget;
            $release->sisa_budget = $saldo_after;
        }else{
            Alert::error('Gagal', 'Budget Anda Kurang');
            return redirect()->back();
        }
        $topup = new TopupBudget();
        $topup->kode = $kode;
        $topup->kode_area = $kode_area;
        $topup->witel = $pool->witel;
        $topup->pool = $request->pool;
        $topup->budget = $request->budget;
        $topup->keterangan = $request->keterangan;

        if($request->budget != null){
            $budget->save();
            $release->save();
            $topup->save();
            Alert::success('Berhasil', 'Anda telah berhasil melakukan distribusi budget');
            return redirect()->back();
        }else{
            Alert::error('Gagal', 'Anda belum input nominal distribusi budget');
            return redirect()->back();
        }
    }

    public function topupBudget($kode_area)
    {
        Auth::user();
        $pool = Pool::where('kode_area', $kode_area)->get();
        
        $budget = TopupBudget::where('kode_area', $kode_area)->get();
        return view('budget.topup', compact('budget', 'pool'));
    }

    public function storeTopup(Request $request, $kode_area)
    {
        Auth::user();
        $this->validate($request,[
            'pool' => 'required'
        ]);
        $timezone = 'Asia/Jakarta';
        $date = new DateTime('now', new DateTimeZone($timezone));
        $format = $date->format('ym');
        $kode = $request->pool.$format;
        $pool = Pool::find($request->pool);
        
        $tanggal = $date->format('Y-m-d');

        $topup = new TopupBudget();
        $topup->kode = $kode;
        $topup->kode_area = $kode_area;
        $topup->witel = $pool->witel;
        $topup->pool = $request->pool;
        $topup->budget = $request->budget;
        $topup->keterangan = $request->keterangan;

        $budget = DistribusiBudget::find($kode);
        $budget_before = $budget->budget_awal;
        $budget_after = $budget_before + $request->budget;
        $budget->budget_awal = $budget_after;
        $sisa_awal = $budget->sisa_budget;
        $sisa_after = $sisa_awal + $request->budget;
        $budget->sisa_budget = $sisa_after;

        $release = ReleaseBudget::find($kode_area.$format);
        $saldo_before = $release->sisa_budget;
        if($request->budget <= $saldo_before){
            $saldo_after = $saldo_before - $request->budget;
            $release->sisa_budget = $saldo_after;
        }else{
            Alert::error('Gagal', 'Budget Anda Kurang');
            return redirect()->back();
        }

        if($request->budget != null){
            $budget->save();
            $release->save();
            $topup->save();
            Alert::success('Berhasil', 'Anda telah berhasil melakukan topup budget');
            return redirect()->back();
        }else{
            Alert::error('Gagal', 'Anda belum input nominal topup budget');
            return redirect()->back();
        }
    }

    public function historyBudget($pool)
    {
        Auth::user();
        $budget = DistribusiBudget::where('pool', $pool)->get();
        return view('budget.history', compact('budget'));
    }

    public function detailHistory($kode)
    {
        Auth::user();
        $budget = TopupBudget::where('kode', $kode)->get();

        return view('budget.detail', compact('budget'));
    }

    public function detailBudget()
    {
        $budget = ReleaseBudget::all();

        return view('budget.detailpusat', compact('budget'));
    }

    public function rincianBudget($kode){
        // $releasenya = Release::find();
        $budget = DistribusiBudget::where('kode_release', $kode)->get();

        return view('budget.rincianpusat', compact('budget'));
    }
}
