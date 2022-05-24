<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DateTime;
use DateTimeZone;
use App\Models\Kendaraan;
use App\Models\Area;
use App\Models\Pool;
use App\Models\Bengkel;
use App\Models\Service;
use App\Models\ServiceDetail;
use App\Models\StokService;
use App\Models\Nonkhs;
use App\Models\RincianStokService;
use App\Models\StokSparepart;
use App\Models\Invoice;
use App\Models\Settings;
use App\Models\ServiceImg;
use App\Models\DistribusiBudget;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Mail\KlikbengkelMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\HistoryExport;
use App\Exports\HistoryExportGsd;

class RequestServiceController extends Controller
{
    //
    public function __construct()
    {
    
    }
    
    public function formAdmin()
    {
        Auth::user();
        $kendaraan = Kendaraan::get();
        $bengkel = Bengkel::orderBy('nama_bengkel', 'asc')->get();
        return view('req-service.ceknopol', compact('kendaraan', 'bengkel'));
    }

    public function oldform($no_service)
    {
        Auth::user();

        $service = Service::find($no_service);
        $kendaraan = Kendaraan::find($service->nopol);
        if($kendaraan->area == 7){
            $stokservice = StokService::where('area', $kendaraan->area)->where('pool', $kendaraan->pool)->where('merk', $kendaraan->merk)
                            ->where('jenis', 'like', '%'.$kendaraan->r2_r4.'%')->get();
            $stokpart = StokSparepart::where('area', $kendaraan->area)->where('pool', $kendaraan->pool)->where('merk', $kendaraan->merk)->get();
        }else{
            $stokservice = StokService::where('area', $kendaraan->area)->where('merk', $kendaraan->merk)
                            ->where('jenis', 'like', '%'.$kendaraan->r2_r4.'%')->get();
            $stokpart = StokSparepart::where('area', $kendaraan->area)->get();
        }
        $rincian = ServiceDetail::where('no_service', $no_service)->get();
        $rinciankhs = ServiceDetail::where('no_service', $no_service)->where('kategori', 'khs')->get();
        $totalkhs = $rinciankhs->sum('subtotal');
        $rinciannon = ServiceDetail::where('no_service', $no_service)->where('kategori', 'non')->get();
        $totalnon = $rinciannon->sum('subtotal');
        $bengkel = Bengkel::where('pool', $kendaraan->pool)->where('r2_r4', 'like', '%'.$kendaraan->r2_r4.'%')->get();
        $setting = Settings::find($service->area);

        return view('req-service.form-lama', compact('kendaraan', 'service', 'bengkel', 'stokservice', 'stokpart', 'rincian', 'setting', 'rinciankhs', 'rinciannon', 'totalkhs', 'totalnon'));
    }

    public function cekNopol($pool)
    {
        Auth::user();
        $kendaraan = Kendaraan::where('pool', $pool)->get();
     
        return view('req-service.ceknopol', compact('kendaraan'));
    }

    public function cekNopolUrg($pool)
    {
        Auth::user();
        $kendaraan = Kendaraan::where('pool', $pool)->get();
 
        return view('req-service.ceknopol-urg', compact('kendaraan'));
    }

    public function cekNopolPart($pool)
    {
        Auth::user();
        $kendaraan = Kendaraan::where('pool', $pool)->get();
 
        return view('req-service.ceknopolpart', compact('kendaraan'));
    }

    public function form($no_service)
    {
        Auth::user();

        $service = Service::find($no_service);
        $kendaraan = Kendaraan::find($service->nopol);
        if($kendaraan->area == 7){
            $stokservice = StokService::where('area', $kendaraan->area)->where('pool', $kendaraan->pool)->where('merk', $kendaraan->merk)
                            ->where('jenis', 'like', '%'.$kendaraan->r2_r4.'%')->get();
            $stokpart = StokSparepart::where('area', $kendaraan->area)->where('pool', $kendaraan->pool)->where('merk', $kendaraan->merk)->get();
        }else{
            $stokservice = StokService::where('area', $kendaraan->area)->where('merk', $kendaraan->merk)
                            ->where('jenis', 'like', '%'.$kendaraan->r2_r4.'%')->get();
            $stokpart = StokSparepart::where('area', $kendaraan->area)->get();
        }
        $rincian = ServiceDetail::where('no_service', $no_service)->get();
        $rinciankhs = ServiceDetail::where('no_service', $no_service)->where('kategori', 'khs')->get();
        $totalkhs = $rinciankhs->sum('subtotal');
        $rinciannon = ServiceDetail::where('no_service', $no_service)->where('kategori', 'non')->get();
        $totalnon = $rinciannon->sum('subtotal');
        $bengkel = Bengkel::where('pool', $kendaraan->pool)->where('r2_r4', 'like', '%'.$kendaraan->r2_r4.'%')->get();
        $setting = Settings::find($service->area);

        return view('req-service.form', compact('kendaraan', 'service', 'bengkel', 'stokservice', 'stokpart', 'rincian', 'setting', 'rinciankhs', 'rinciannon', 'totalkhs', 'totalnon'));
    }

    public function formUrg($no_service)
    {
        Auth::user();

        $service = Service::find($no_service);
        $kendaraan = Kendaraan::find($service->nopol);
        if($kendaraan->area == 7){
            $stokservice = StokService::where('area', $kendaraan->area)->where('pool', $kendaraan->pool)->where('merk', $kendaraan->merk)
                            ->where('jenis', 'like', '%'.$kendaraan->r2_r4.'%')->get();
            $stokpart = StokSparepart::where('area', $kendaraan->area)->where('pool', $kendaraan->pool)->where('merk', $kendaraan->merk)->get();
        }else{
            $stokservice = StokService::where('area', $kendaraan->area)->where('merk', $kendaraan->merk)
                            ->where('jenis', 'like', '%'.$kendaraan->r2_r4.'%')->get();
            $stokpart = StokSparepart::where('area', $kendaraan->area)->get();
        }
        $rincian = ServiceDetail::where('no_service', $no_service)->get();
        $rinciankhs = ServiceDetail::where('no_service', $no_service)->where('kategori', 'khs')->get();
        $totalkhs = $rinciankhs->sum('subtotal');
        $rinciannon = ServiceDetail::where('no_service', $no_service)->where('kategori', 'non')->get();
        $totalnon = $rinciannon->sum('subtotal');
        $bengkel = Bengkel::where('pool', $kendaraan->pool)->where('r2_r4', 'like', '%'.$kendaraan->r2_r4.'%')->get();
        $setting = Settings::find($service->area);

        return view('req-service.form-urg', compact('kendaraan', 'service', 'bengkel', 'stokservice', 'stokpart', 'rincian', 'setting', 'rinciankhs', 'rinciannon', 'totalkhs', 'totalnon'));
    }

    public function formPart($no_service)
    {
        Auth::user();

        $service = Service::find($no_service);
        $kendaraan = Kendaraan::find($service->nopol);
        if($kendaraan->area == 7){
            $stokservice = StokService::where('area', $kendaraan->area)->where('pool', $kendaraan->pool)->where('merk', $kendaraan->merk)
                            ->where('jenis', 'like', '%'.$kendaraan->r2_r4.'%')->get();
            $stokpart = StokSparepart::where('area', $kendaraan->area)->where('pool', $kendaraan->pool)->where('merk', $kendaraan->merk)->get();
        }else{
            $stokservice = StokService::where('area', $kendaraan->area)->where('merk', $kendaraan->merk)
                            ->where('jenis', 'like', '%'.$kendaraan->r2_r4.'%')->get();
            $stokpart = StokSparepart::where('area', $kendaraan->area)->get();
        }
        $rincian = ServiceDetail::where('no_service', $no_service)->get();
        $rinciankhs = ServiceDetail::where('no_service', $no_service)->where('kategori', 'khs')->get();
        $totalkhs = $rinciankhs->sum('subtotal');
        $rinciannon = ServiceDetail::where('no_service', $no_service)->where('kategori', 'non')->get();
        $totalnon = $rinciannon->sum('subtotal');
        $bengkel = Bengkel::where('pool', $kendaraan->pool)->where('r2_r4', 'like', '%'.$kendaraan->r2_r4.'%')->get();
        $setting = Settings::find($service->area);

        return view('req-service.form-part', compact('kendaraan', 'service', 'bengkel', 'stokservice', 'stokpart', 'rincian', 'setting', 'rinciankhs', 'rinciannon', 'totalkhs', 'totalnon'));
    }

    public function detailService($no_service)
    {
        Auth::user();
        $service = Service::find($no_service);
        $kendaraan = Kendaraan::find($service->nopol);
        $stokservice = StokService::where('area', $kendaraan->area)->where('merk', $kendaraan->merk)
        ->where('jenis', 'like', '%'.$kendaraan->r2_r4.'%')->get();
        $stokpart = StokSparepart::where('area', $kendaraan->area)->get();
        $rincian = ServiceDetail::where('no_service', $no_service)->get();
        $rinciankhs = ServiceDetail::where('no_service', $no_service)->where('kategori', 'khs')->get();
        $totalkhs = $rinciankhs->sum('subtotal');
        $rinciannon = ServiceDetail::where('no_service', $no_service)->where('kategori', 'non')->get();
        $totalnon = $rinciannon->sum('subtotal');
        $bengkel = Bengkel::where('pool', $kendaraan->pool)->where('r2_r4', 'like', '%'.$kendaraan->r2_r4.'%')->get();
        $setting = Settings::find($service->area);

        return view('req-service.detail', compact('kendaraan', 'service', 'bengkel', 'stokservice', 'stokpart', 'rincian', 'setting', 'rinciankhs', 'rinciannon', 'totalkhs', 'totalnon'));
    }
    public function detailApproval($no_service)
    {
        Auth::user();
        $service = Service::find($no_service);
        $bengkel = Bengkel::where('pool', $service->pool)->get();
        $rinciankhs = ServiceDetail::where('no_service', $no_service)->where('kategori', 'khs')->get();
        $totalkhs = $rinciankhs->sum('subtotal');
        $rinciannon = ServiceDetail::where('no_service', $no_service)->where('kategori', 'non')->get();
        $totalnon = $rinciannon->sum('subtotal');

        return view('req-service.detailApproval', compact('service', 'bengkel', 'rinciankhs', 'totalkhs', 'rinciannon', 'totalnon'));
    }

    public function storeService(Request $request)
    {
        Auth::user();
        $timezone = 'Asia/Jakarta';
        $date = new DateTime('now', new DateTimeZone($timezone));
        $tahun = $date->format('ym');
        $tanggal = $date->format('d');
        $tanggalservice = $date->format('Y-m-d');
        $kendaraan = Kendaraan::find($request->nopol);
        if($kendaraan == NULL){
            Alert::error('Gagal', 'Nopol Tidak Ada Di Sistem');
            return redirect()->back();
        }
        $area = $kendaraan->area;
        $pool = substr($kendaraan->pool, 0, 3);
        $poolnya = Pool::find($kendaraan->pool);

        if($poolnya->distribusi != NULL && $poolnya->distribusi->sisa_budget != 0){
            $prefix = 'CK-'.'A'.$area.'-'.$pool.$tahun.'-'.$tanggal;
            $kode_service = IdGenerator::generate(['table' => 'service', 'field' => 'no_service', 'reset_on_prefix_change' =>true, 'length' => 20, 'prefix' =>$prefix]);
            $service = new Service();
            $service->no_service = $kode_service;
            $service->nopol = $request->nopol;
            $service->tanggal = $tanggalservice;
            $service->area = $kendaraan->area;
            $service->witel = $kendaraan->witel;
            $service->pool = $kendaraan->pool;
            $service->save();

            return redirect()->action([RequestServiceController::class, 'form'], [$kode_service]);
        }else{
            Alert::error('Gagal', 'Anda tidak mempunyai budget Bulan ini atau Budget anda sudah habis!');
            return redirect()->back();
        }
    }

    public function storeServiceUrg(Request $request)
    {
        Auth::user();
        $timezone = 'Asia/Jakarta';
        $date = new DateTime('now', new DateTimeZone($timezone));
        $tahun = $date->format('ym');
        $tanggal = $date->format('d');
        $tanggalservice = $date->format('Y-m-d');
        $kendaraan = Kendaraan::findOrFail($request->nopol);
        if($kendaraan == NULL){
            Alert::error('Gagal', 'Nopol Tidak Ada Di Sistem');
            return redirect()->back();
        }
        $area = $kendaraan->area;
        $pool = substr($kendaraan->pool, 0, 3);
        $poolnya = Pool::find($kendaraan->pool);

        if($poolnya->distribusi != NULL && $poolnya->distribusi->sisa_budget != 0){
            $prefix = 'CK-'.'A'.$area.'-'.$pool.$tahun.'-'.$tanggal;
            $kode_service = IdGenerator::generate(['table' => 'service', 'field' => 'no_service', 'reset_on_prefix_change' =>true, 'length' => 20, 'prefix' =>$prefix]);
            $service = new Service();
            $service->no_service = $kode_service;
            $service->nopol = $request->nopol;
            $service->tanggal = $tanggalservice;
            $service->area = $kendaraan->area;
            $service->witel = $kendaraan->witel;
            $service->pool = $kendaraan->pool;
            $service->save();

            return redirect()->action([RequestServiceController::class, 'formUrg'], [$kode_service]);
        }else{
            Alert::error('Gagal', 'Anda tidak mempunyai budget Bulan ini atau Budget anda sudah habis!!');
            return redirect()->back();
        }
    }

    public function storeServicePart(Request $request)
    {
        Auth::user();
        $timezone = 'Asia/Jakarta';
        $date = new DateTime('now', new DateTimeZone($timezone));
        $tahun = $date->format('ym');
        $tanggal = $date->format('d');
        $tanggalservice = $date->format('Y-m-d');
        $kendaraan = Kendaraan::find($request->nopol);
        if($kendaraan == NULL){
            Alert::error('Gagal', 'Nopol Tidak Ada Di Sistem');
            return redirect()->back();
        }
        $area = $kendaraan->area;
        $pool = substr($kendaraan->pool, 0, 3);
        $poolnya = Pool::find($kendaraan->pool);

        if($poolnya->distribusi != NULL && $poolnya->distribusi->sisa_budget != 0){
            $prefix = 'CK-'.'A'.$area.'-'.$pool.$tahun.'-'.$tanggal;
            $kode_service = IdGenerator::generate(['table' => 'service', 'field' => 'no_service', 'reset_on_prefix_change' =>true, 'length' => 20, 'prefix' =>$prefix]);
            $service = new Service();
            $service->no_service = $kode_service;
            $service->nopol = $request->nopol;
            $service->tanggal = $tanggalservice;
            $service->area = $kendaraan->area;
            $service->witel = $kendaraan->witel;
            $service->pool = $kendaraan->pool;
            $service->save();

            return redirect()->action([RequestServiceController::class, 'formPart'], [$kode_service]);
        }else{
            Alert::error('Gagal', 'Anda tidak mempunyai budget Bulan ini atau Budget anda sudah habis!!');
            return redirect()->back();
        }
    }

    public function storeRincian(Request $request, $no_service)
    {
        Auth::user();
        $this->validate($request,[
            'qty' => 'required'
        ]);

        $rincian = new ServiceDetail();
        $rincian->no_service = $no_service;
        $rincian->kategori = 'khs';
        $rincian->jenis_service = $request->selectService;
        if($request->selectService == 'berkala'){
            $stokservice = StokService::find($request->keterangan);
            $rincian->keterangan = $stokservice->nama_service;
        }else{
            $stokpart = StokSparepart::find($request->keterangan1);
            $rincian->keterangan = $stokpart->nama;
        }
        if($request->selectService == 'berkala'){
            $rincian->harga = $stokservice->harga;
        }else{
            $rincian->harga = $stokpart->jumlah;
        }
        $rincian->qty = $request->qty;
        $rincian->subtotal = $rincian->harga * $request->qty; 
        $service = Service::find($no_service);
        $jumlahawal = $service->subtotal;
        $jumlahbaru = $jumlahawal + $rincian->subtotal;
        $service->subtotal = $jumlahbaru;
        $ppn = $jumlahbaru*0;
        $service->ppn = $ppn;
        $service->total = $jumlahbaru+$ppn;
        $poolnya = Pool::find($service->pool);
        $timezone = 'Asia/Jakarta';
        $date = $service->created_at;
        $format = $date->format('ym');
        $kode = $poolnya->pool.$format;
        $budget = DistribusiBudget::find($kode);

        if($rincian->subtotal <= $budget->sisa_budget){
            $budget_after = $budget->sisa_budget - $rincian->subtotal;
            $budget->sisa_budget = $budget_after; 
            $budget->save();
            $service->save();
            $rincian->save();
            Alert::success('Berhasil', 'Anda telah berhasil menambahkan rincian service');
            return redirect()->back();
        }else{
            Alert::error('Gagal', 'Budget anda tidak cukup');
            return redirect()->back();
        }
       
    }

    public function storePart(Request $request, $no_service)
    {
        Auth::user();
        $this->validate($request,[
            'qty' => 'required'
        ]);

        $rincian = new ServiceDetail();
        $rincian->no_service = $no_service;
        $rincian->jenis_service = 'part';
        $rincian->kategori = 'khs';
        $stokpart = StokSparepart::find($request->keterangan1);
        $rincian->keterangan = $stokpart->nama;
        $rincian->harga = $stokpart->jumlah;
        
        $rincian->qty = $request->qty;
        $rincian->subtotal = $rincian->harga * $request->qty; 
        $service = Service::find($no_service);
        $jumlahawal = $service->subtotal;
        $jumlahbaru = $jumlahawal + $rincian->subtotal;
        $service->subtotal = $jumlahbaru;
        $ppn = $jumlahbaru*0;
        $service->ppn = $ppn;
        $service->total = $jumlahbaru+$ppn;
        $poolnya = Pool::find($service->pool);
        $timezone = 'Asia/Jakarta';
        $date = new DateTime('now', new DateTimeZone($timezone));
        $format = $date->format('ym');
        $kode = $poolnya->pool.$format;
        $budget = DistribusiBudget::find($kode);

        if($jumlahbaru <= $budget->sisa_budget){
            $budget_after = $budget->sisa_budget - $rincian->subtotal;
            $budget->sisa_budget = $budget_after; 
            $budget->save();
            $service->save();
            $rincian->save();
            Alert::success('Berhasil', 'Anda telah berhasil menambahkan rincian service');
            return redirect()->back();
        }else{
            Alert::error('Gagal', 'Budget anda tidak cukup');
            return redirect()->back();
        }
       
    }

    public function storeNonKhs(Request $request, $no_service)
    {
        Auth::user();
        $this->validate($request,[
            'qty' => 'required'
        ]);
        $service = Service::find($no_service);
        $nonkhs = new Nonkhs();
        $nonkhs->area = $service->area;
        $nonkhs->nama = $request->nama;
        $harga = $request->harga + ($request->harga * 0.25);
        $nonkhs->harga = $harga;
        
        if($service->jenis_bengkel == NULL){
            Alert::error('Gagal', 'Anda belum memasukkan data bengkel');
            return redirect()->back();
        }else{
            $rincian = new ServiceDetail();
            $rincian->no_service = $no_service;
            $rincian->jenis_service = 'Berkala atau Ganti Part Non KHS';
            $rincian->keterangan = $request->nama;
            $rincian->kategori = 'non';
            $rincian->harga = $harga;
            $rincian->qty = $request->qty;
            $rincian->subtotal = $harga * $rincian->qty; 
            $jumlahawal = $service->subtotal;
            $jumlahbaru = $jumlahawal + $rincian->subtotal;
            $service->subtotal = $jumlahbaru;
            if($service->jenis_bengkel == 'nonrekanan'){
                $ppn = $rincian->subtotal*0.1;
            }else{
                $ppn = $rincian->subtotal*0;
            }
            $ppnlama = $service->ppn;
            $ppnbaru = $ppnlama + $ppn;
            $service->ppn = $ppnbaru;
            $service->total = $jumlahbaru+$ppnbaru;
            $poolnya = Pool::find($service->pool);
            $timezone = 'Asia/Jakarta';
            $date = new DateTime('now', new DateTimeZone($timezone));
            $format = $date->format('ym');
            $kode = $poolnya->pool.$format;
            $budget = DistribusiBudget::find($kode);
    
            if($rincian->harga <= $budget->sisa_budget){
                $budget_after = $budget->sisa_budget - $rincian->subtotal;
                $budget->sisa_budget = $budget_after; 
                $budget->save();
                $nonkhs->save();
                $service->save();
                $rincian->save();
                Alert::success('Berhasil', 'Anda telah berhasil menambahkan rincian service');
                return redirect()->back();
            }else{
                Alert::error('Gagal', 'Budget anda tidak cukup');
                return redirect()->back();
            }
        }
        
    }

    public function storeRincianUrg(Request $request, $no_service)
    {
        Auth::user();
        $this->validate($request,[
            'qty' => 'required'
        ]);

        $rincian = new ServiceDetail();
        $rincian->no_service = $no_service;
        $rincian->jenis_service = $request->selectService;
        if($request->selectService == 'berkala'){
            $stokservice = StokService::find($request->keterangan);
            $rincian->keterangan = $stokservice->nama_service;
        }else{
            $stokpart = StokSparepart::find($request->keterangan1);
            $rincian->keterangan = $stokpart->nama;
        }
        
        if($request->selectService == 'berkala'){
            $rincian->harga = $stokservice->harga;
        }else{
            $rincian->harga = $stokpart->jumlah;
        }
        $rincian->qty = $request->qty;
        $rincian->subtotal = $rincian->harga * $request->qty; 
        $service = Service::find($no_service);
        $jumlahawal = $service->subtotal;
        $jumlahbaru = $jumlahawal + $rincian->subtotal;
        $service->subtotal = $jumlahbaru;
        $ppn = $jumlahbaru*0.1;
        $service->ppn = $ppn;
        $service->total = $jumlahbaru+$ppn;
        $poolnya = Pool::find($service->pool);
        $timezone = 'Asia/Jakarta';
        $date = new DateTime('now', new DateTimeZone($timezone));
        $format = $date->format('ym');
        $kode = $poolnya->pool.$format;
        $budget = DistribusiBudget::find($kode);

        if($jumlahbaru <= $budget->sisa_budget){
            $budget_after = $budget->sisa_budget - $rincian->subtotal;
            $budget->sisa_budget = $budget_after; 
            $budget->save();
            $service->save();
            $rincian->save();
            Alert::success('Berhasil', 'Anda telah berhasil menambahkan rincian service');
            return redirect()->back();
        }else{
            Alert::error('Gagal', 'Budget anda tidak cukup');
            return redirect()->back();
        }
    }

    public function deleteRequest($no_service)
    {
        $service = Service::find($no_service);
        $rincian = ServiceDetail::where('no_service', $no_service)->get();

        $timezone = 'Asia/Jakarta';
        $poolnya = Pool::find($service->pool);
        $date = $service->created_at;
        $format = $date->format('ym');
        $kode = $poolnya->pool.$format;
        $budget = DistribusiBudget::find($kode);
        $budgetService = $service->subtotal;
        $budget_after = $budget->sisa_budget + $budgetService;
        $budget->sisa_budget = $budget_after; 
        // dd($budget);
        $budget->save();
        $service->delete();
        Alert::success('Berhasil', 'Anda telah berhasil membatalkan service');

        return redirect()->route('request.cek', Auth::user()->resp);
    }

    public function deleteRincian($id)
    {
        $rincian = ServiceDetail::find($id);
        $service = Service::find($rincian->no_service);
        $jumlahawal = $service->subtotal;
        $jumlahbaru = $jumlahawal - $rincian->subtotal;
        $service->subtotal = $jumlahbaru;
        $ppn = $jumlahbaru*0;
        $service->ppn = $ppn;
        $service->total = $jumlahbaru+$ppn;
        $poolnya = Pool::find($service->pool);
        $timezone = 'Asia/Jakarta';
        $date = $service->created_at;
        // dd($date);
        $format = $date->format('ym');
        // dd($format);
        $kode = $poolnya->pool.$format;
        $budget = DistribusiBudget::find($kode);
        $budget_after = $budget->sisa_budget + $rincian->subtotal;
        $budget->sisa_budget = $budget_after;
        $rincian->delete();
        $service->save();
        $budget->save();
        Alert::success('Berhasil', 'Anda telah berhasil menghapus rincian service');

        return redirect()->back();
    }

    public function deleteRincianNon($id)
    {
        $rincian = ServiceDetail::find($id);
        $service = Service::find($rincian->no_service);
        $jumlahawal = $service->subtotal;
        $jumlahbaru = $jumlahawal - $rincian->subtotal;
        $service->subtotal = $jumlahbaru;
        $oldppn = $service->ppn;
        if($service->jenis_bengkel == 'nonrekanan'){
            $ppn = $rincian->subtotal*0.1;
        }else{
            $ppn = $rincian->subtotal*0;
        }
        // dd($ppn);
        $service->ppn = $oldppn - $ppn;
        $service->total = $jumlahbaru+$service->ppn;
        
        $poolnya = Pool::find($service->pool);
        $timezone = 'Asia/Jakarta';
        $date = $service->created_at;
        // dd($date);
        $format = $date->format('ym');
        // dd($format);
        $kode = $poolnya->pool.$format;
        $budget = DistribusiBudget::find($kode);
        $budget_after = $budget->sisa_budget + $rincian->subtotal;
        $budget->sisa_budget = $budget_after;
        $rincian->delete();
        $service->save();
        $budget->save();
        Alert::success('Berhasil', 'Anda telah berhasil menghapus rincian service');

        return redirect()->back();
    }

    public function deleteRincianUrg($id)
    {
        $rincian = ServiceDetail::find($id);
        $service = Service::find($rincian->no_service);
        $jumlahawal = $service->subtotal;
        $jumlahbaru = $jumlahawal - $rincian->subtotal;
        $service->subtotal = $jumlahbaru;
        $ppn = $jumlahbaru*0.1;
        $service->ppn = $ppn;
        $service->total = $jumlahbaru+$ppn;
        $poolnya = Pool::find($service->pool);
        $timezone = 'Asia/Jakarta';
        $date = new DateTime('now', new DateTimeZone($timezone));
        $format = $date->format('ym');
        $kode = $poolnya->pool.$format;
        $budget = DistribusiBudget::find($kode);
        $budget_after = $budget->sisa_budget + $jumlahawal;
        $budget->sisa_budget = $budget_after;
        $rincian->delete();
        $service->save();
        $budget->save();
        Alert::success('Berhasil', 'Anda telah berhasil menghapus rincian service');

        return redirect()->back();
    }

    public function storeBengkel(Request $request, $no_service)
    {
        Auth::user();
        $service = Service::find($no_service);
        $service->jenis_bengkel = $request->selectBengkel;
        if($request->selectBengkel == 'rekanan'){
            $service->bengkel = $request->bengkel1;
        }else{
            $service->bengkel = $request->bengkel;
        }
        $service->save();

        Alert::success('Berhasil', 'Anda telah berhasil menambahkan data bengkel');
        return redirect()->back();
    }

    public function updateService(Request $request, $no_service)
    {
        Auth::user();

        $service = Service::find($no_service);
        $kendaraan = Kendaraan::find($service->nopol);
        $area = Area::find($kendaraan->area);

        $service->km = $request->km;
        $service->reg_urg = 'Regular';
        $kendaraan->last_service = $service->tanggal;
        $validasiKm = $service->km - $kendaraan->km;
        $monthLast = $kendaraan->last_service;
        $service->status = 'Waiting';
        $setting = Settings::find($service->area);

        if($request->hasFile('foto')){
            $serviceImg = new ServiceImg();
            $file = $request->file('foto');
            $namafile = str_replace('','',$no_service.'-'.$service->nopol.'-'.'sebelum service');
            $tujuan = 'bukti-service';
            $file->move($tujuan,$namafile);
            $serviceImg->no_service = $no_service;
            $serviceImg->foto_before = $namafile;
            
        }
	
        if($kendaraan->r2_r4 == 'R4'){ 
            if($validasiKm >= $setting->km && $request->foto != NULL && $service->total != NULL){
                try{
                    Mail::send('email.asman', compact('area', 'service'), function($message) use ($area){
                        $message->from(Auth::user()->email, Auth::user()->name);
                        $message->to($area->user->email)->subject('Permohonan Approval');
                    });
                }catch(exception $e){
                    return response ($e->getMessage(), 422);
                }
                $service->save();
                $kendaraan->save();
                $serviceImg->save();
                if(Auth::user()->isAsman()){
                    Alert::success('Berhasil', 'Anda telah berhasil melakukan request service');
                    return redirect()->route('request.historyarea', $service->area);
                }elseif(Auth::user()->isDispatcher()){
                    Alert::success('Berhasil', 'Anda telah berhasil melakukan request service');
                    return redirect()->route('request.historypool', $service->pool);
                }else{
                    Alert::success('Berhasil', 'Anda telah berhasil melakukan request service');
                    return redirect()->route('request.history');
                }
            }else{
                Alert::error('Validasi Gagal', 'Mohon dicek odoometer, foto bukti dan rincian service');
                return redirect()->back()->withInput();
            }
        }else{
            if($request->foto != NULL && $service->total != NULL && $service->km != NULL){
                try{
                    Mail::send('email.asman', compact('area', 'service'), function($message) use ($area){
                        $message->from(Auth::user()->email, Auth::user()->name);
                        $message->to($area->user->email)->subject('Permohonan Approval');
                    });
                }catch(exception $e){
                    return response ($e->getMessage(), 422);
                }
                $service->save();
                $kendaraan->save();
                $serviceImg->save();
                if(Auth::user()->isAsman()){
                    Alert::success('Berhasil', 'Anda telah berhasil melakukan request service');
                    return redirect()->route('request.historyarea', $service->area);
                }elseif(Auth::user()->isDispatcher()){
                    Alert::success('Berhasil', 'Anda telah berhasil melakukan request service');
                    return redirect()->route('request.historypool', $service->pool);
                }else{
                    Alert::success('Berhasil', 'Anda telah berhasil melakukan update request service');
                    return redirect()->route('request.history');
                }
            }else{
                Alert::error('Validasi Gagal', 'Mohon dicek odoometer, foto bukti dan rincian service');
                return redirect()->back()->withInput();
            }
        }
    }

    public function updateDetail(Request $request, $no_service)
    {
        Auth::user();

        $service = Service::find($no_service);
        $kendaraan = Kendaraan::find($service->nopol);
        $area = Area::find($kendaraan->area);

        $service->km = $request->km;
        $kendaraan->last_service = $service->tanggal;
        $validasiKm = $service->km - $kendaraan->km;
        $monthLast = $kendaraan->last_service;

        if($service->status == 'On Service'){
            $service->status = 'Waiting';
            $setting = Settings::find($service->area);
            $serviceImg = ServiceImg::find($no_service);
            if($request->hasFile('foto')){
                $file = $request->file('foto');
                $namafile = str_replace('','',$no_service.'-'.$service->nopol.'-'.'sebelum service');
                $tujuan = 'bukti-service';
                $file->move($tujuan,$namafile);
                $serviceImg->no_service = $no_service;
                $serviceImg->foto_before = $namafile;
            }  
                if($service->total != NULL){
                    Mail::send('email.asman', compact('area', 'service'), function($message) use ($area){
                        $message->from(Auth::user()->email, Auth::user()->name);
                        $message->to($area->user->email)->subject('Permohonan Approval (Update Rincian)');
                    });
                    $service->save();
                    $kendaraan->save();
                    if($request->foto != null){
                    $serviceImg->save();}
                    if(Auth::user()->isAsman()){
                        Alert::success('Berhasil', 'Anda telah berhasil melakukan update request service');
                        return redirect()->route('request.historyarea', $service->area);
                    }elseif(Auth::user()->isDispatcher()){
                        Alert::success('Berhasil', 'Anda telah berhasil melakukan update request service');
                        return redirect()->route('request.historypool', $service->pool);
                    }else{
                        Alert::success('Berhasil', 'Anda telah berhasil melakukan request service');
                        return redirect()->route('request.history');
                    }
                }else{
                    Alert::error('Validasi Gagal', 'Mohon dicek odoometer');
                    return redirect()->back();
                }
            
        }else{
            $service->status = 'Waiting';
            $setting = Settings::find($service->area);
            $serviceImg = ServiceImg::find($no_service);
            if($request->hasFile('foto')){
                $file = $request->file('foto');
                $namafile = str_replace('','',$no_service.'-'.$service->nopol.'-'.'sebelum service');
                $tujuan = 'bukti-service';
                $file->move($tujuan,$namafile);
                $serviceImg->no_service = $no_service;
                $serviceImg->foto_before = $namafile;
                
            }
            if($kendaraan->r2_r4 == 'R4'){
                if($service->total != NULL && $service->km != NULL){
                    
                    Mail::send('email.asman', compact('area', 'service'), function($message) use ($area){
                        $message->from(Auth::user()->email, Auth::user()->name);
                        $message->to($area->user->email)->subject('Permohonan Approval (Updated)');
                    });
                    $service->save();
                    $kendaraan->save();
                    if($request->foto != null){
                    $serviceImg->save();}
                    if(Auth::user()->isAsman()){
                        Alert::success('Berhasil', 'Anda telah berhasil melakukan update request service');
                        return redirect()->route('request.historyarea', $service->area);
                    }elseif(Auth::user()->isDispatcher()){
                        Alert::success('Berhasil', 'Anda telah berhasil melakukan update request service');
                        return redirect()->route('request.historypool', $service->pool);
                    }else{
                        Alert::success('Berhasil', 'Anda telah berhasil melakukan request service');
                        return redirect()->route('request.history');
                    }
                }else{
                    Alert::error('Validasi Gagal', 'Mohon dicek kembali');
                    return redirect()->back();
                }
            }else{
                if($service->total != NULL && $service->km != NULL){
                    
                    Mail::send('email.asman', compact('area', 'service'), function($message) use ($area){
                        $message->from(Auth::user()->email, Auth::user()->name);
                        $message->to($area->user->email)->subject('Permohonan Approval (Updated)');
                    });
                    $service->save();
                    $kendaraan->save();
                    if($request->foto != null){
                    $serviceImg->save();}
                    if(Auth::user()->isAsman()){
                        Alert::success('Berhasil', 'Anda telah berhasil melakukan update request service');
                        return redirect()->route('request.historyarea', $service->area);
                    }elseif(Auth::user()->isDispatcher()){
                        Alert::success('Berhasil', 'Anda telah berhasil melakukan request service');
                        return redirect()->route('request.historypool', $service->pool);
                    }else{
                        Alert::success('Berhasil', 'Anda telah berhasil melakukan request service');
                        return redirect()->route('request.history');
                    }
                }else{
                    Alert::error('Validasi Gagal', 'Mohon dicek odoometer');
                    return redirect()->back();
                }
            }
        }
        
    }


    public function updateServiceUrg(Request $request, $no_service)
    {
        Auth::user();

        $service = Service::find($no_service);
        $kendaraan = Kendaraan::find($service->nopol);
        $area = Area::find($kendaraan->area);
       
        $service->km = $request->km;
        $service->reg_urg = 'Urgent';
        $kendaraan->last_service = $service->tanggal;
        $validasiKm = $service->km - $kendaraan->km;
        $monthLast = $kendaraan->last_service;
        $service->status = 'Waiting';
        $setting = Settings::find($service->area);

        if($request->hasFile('foto')){
            $serviceImg = new ServiceImg();
            
            $file = $request->file('foto');
            $namafile = str_replace('','',$no_service.'-'.$service->nopol.'-'.'sebelum service');
            $tujuan = 'bukti-service';
            $file->move($tujuan,$namafile);
            $serviceImg->no_service = $no_service;
            $serviceImg->foto_before = $namafile;
            
        }
        if($request->foto != NULL && $service->total != NULL && $service->km != NULL){
            
            Mail::send('email.asman', compact('area', 'service'), function($message) use ($area){
                $message->from(Auth::user()->email, Auth::user()->name);
                $message->to($area->user->email)->subject('Permohonan Approval');
            });
            $service->save();
            $kendaraan->save();
            $serviceImg->save();
            if(Auth::user()->isAsman()){
                Alert::success('Berhasil', 'Anda telah berhasil melakukan request service');
                return redirect()->route('request.historyarea', $service->area);
            }elseif(Auth::user()->isDispatcher()){
                Alert::success('Berhasil', 'Anda telah berhasil melakukan request service');
                return redirect()->route('request.historypool', $service->pool);
            }else{
                Alert::success('Berhasil', 'Anda telah berhasil melakukan request service');
                return redirect()->route('request.history');
            }
        }else{
            Alert::error('Validasi Gagal', 'Bukti Service Belum Ada atau Rincian Service Kosong');
            return redirect()->back();
        }
    }

    public function updateServicePart(Request $request, $no_service)
    {
        Auth::user();

        $service = Service::find($no_service);
        $kendaraan = Kendaraan::find($service->nopol);
        $area = Area::find($kendaraan->area);
       
        $service->km = $request->km;
        $service->reg_urg = 'Ganti Part';
        $kendaraan->last_service = $service->tanggal;
        $validasiKm = $service->km - $kendaraan->km;
        $monthLast = $kendaraan->last_service;
        $service->status = 'Waiting';
        $setting = Settings::find($service->area);

        if($request->hasFile('foto')){
            $serviceImg = new ServiceImg();
            
            $file = $request->file('foto');
            $namafile = str_replace('','',$no_service.'-'.$service->nopol.'-'.'sebelum service');
            $tujuan = 'bukti-service';
            $file->move($tujuan,$namafile);
            $serviceImg->no_service = $no_service;
            $serviceImg->foto_before = $namafile;
            
        }
        if($request->foto != NULL && $service->total != NULL && $service->km != NULL){
            
            Mail::send('email.asman', compact('area', 'service'), function($message) use ($area){
                $message->from(Auth::user()->email, Auth::user()->name);
                $message->to($area->user->email)->subject('Permohonan Approval');
            });
            $service->save();
            $kendaraan->save();
            $serviceImg->save();
            if(Auth::user()->isAsman()){
                Alert::success('Berhasil', 'Anda telah berhasil melakukan request service');
                return redirect()->route('request.historyarea', $service->area);
            }elseif(Auth::user()->isDispatcher()){
                Alert::success('Berhasil', 'Anda telah berhasil melakukan request service');
                return redirect()->route('request.historypool', $service->pool);
            }else{
                Alert::success('Berhasil', 'Anda telah berhasil melakukan request service');
                return redirect()->route('request.history');
            }
        }else{
            Alert::error('Validasi Gagal', 'Bukti Service Belum Ada atau Rincian Service Kosong');
            return redirect()->back();
        }
    }

    public function approveService($no_service)
    {
        $service = Service::find($no_service);
        $kendaraan = Kendaraan::find($service->nopol);
        $kendaraan->km = $service->km;
        $kendaraan->save();
        $service->status = 'On Service';
        $status = 'Disetujui';
        $pool = Pool::find($service->kendaraan->pool);
        Mail::send('email.disp', compact('pool', 'service', 'status'), function($message) use ($pool){
            $message->from(Auth::user()->email, Auth::user()->name);
            $message->to($pool->user->email)->subject('Hasil Approval');
        });
        $service->save();

        Alert::success('Berhasil', 'Anda telah berhasil melakukan approval service');
        return redirect()->route('request.approval', Auth::user()->resp);
    }

    public function declineService($no_service)
    {
        $service = Service::find($no_service);
        $service->status = 'Decline';
        $status = 'Ditolak';
        $pool = Pool::find($service->kendaraan->pool);
        $timezone = 'Asia/Jakarta';
        $date = $service->created_at;
        $format = $date->format('ym');
        $kode = $pool->pool.$format;
        $budget = DistribusiBudget::find($kode);
        $budget_after = $budget->sisa_budget + $service->subtotal;
        $budget->sisa_budget = $budget_after;
        Mail::send('email.disp', compact('pool', 'service', 'status'), function($message) use ($pool){
            $message->from(Auth::user()->email, Auth::user()->name);
            $message->to($pool->user->email)->subject('Hasil Approval');
        });
        $budget->save();
        $service->save();

        Alert::success('Berhasil', 'Anda telah berhasil melakukan decline service');
        return redirect()->route('request.approval', Auth::user()->resp);
    }

    public function history(Request $request)
    {
        $service = Service::where('status', '!=', NULL)->orderBy('created_at', 'desc')->paginate(15);
        $area = Area::all();
        $status = Service::where('status', '!=', 'NULL')->distinct()->get('status');
        $areanya = $request->area;
        $statusnya = $request->status;
        $tgl_awal = $request->tgl_awal;
        // dd($tgl_awal);
        $tgl_akhir = $request->tgl_akhir;

        return view('hist-service.table', compact('service', 'area', 'status', 'areanya', 'statusnya', 'tgl_awal', 'tgl_akhir'));
    }

    public function historyGsd(Request $request)
    {
        $service = Service::where('status', '!=', NULL)->orderBy('created_at', 'desc')->paginate(15);
        $area = Area::all();
        $status = Service::where('status', '!=', 'NULL')->distinct()->get('status');
        $areanya = $request->area;
        $statusnya = $request->status;
        $tgl_awal = $request->tgl_awal;
        // dd($tgl_awal);
        $tgl_akhir = $request->tgl_akhir;

        return view('hist-service.tablegsd', compact('service', 'area', 'status', 'areanya', 'statusnya', 'tgl_awal', 'tgl_akhir'));
    }

    public function historyArea(Request $request, $kode_area)
    {
        $service = Service::where('status', '!=', NULL)->where('area', $kode_area)->orderBy('created_at', 'desc')->paginate(15);
        $area = Area::where('kode_area', $kode_area)->get();
        // dd($area);
        $status = Service::where('status', '!=', 'NULL')->distinct()->get('status');
        $areanya = $request->area;
        $statusnya = $request->status;
        $tgl_awal = $request->tgl_awal;
        // dd($tgl_awal);
        $tgl_akhir = $request->tgl_akhir;
        return view('hist-service.table', compact('service', 'area', 'status', 'areanya', 'statusnya', 'tgl_awal', 'tgl_akhir'));
    }

    public function historyPool($pool)
    {
        $service = Service::where('status', '!=', NULL)->where('pool', $pool)->orderBy('created_at', 'desc')->paginate(15);
        return view('hist-service.table', compact('service'));
    }

    public function approval()
    {
        $service = Service::where('status', 'Waiting')->orderBy('created_at', 'asc')->paginate(15);
        return view('req-service.approval', compact('service'));
    }

    public function approvalArea($kode_area)
    {

        $service = Service::where('area', $kode_area)->where('status', 'Waiting')->orderBy('created_at', 'asc')->paginate(15);
        return view('req-service.approval', compact('service'));
    }

    public function complete()
    {
        $service = Service::where('status', 'On Service')->orderBy('created_at', 'asc')->paginate(15);
        return view('complete.index', compact('service'));
    }

    public function completePool($pool)
    {

        $service = Service::where('pool', $pool)->where('status', 'On Service')->orderBy('created_at', 'asc')->paginate(15);
        return view('complete.index', compact('service'));
    }

    public function cariComplete(Request $request)
    {
        $search = $request->input('search');

        $service = Service::query()
            ->where('nopol', 'LIKE', "%{$search}%")
            ->orWhere('no_service', 'LIKE', "%{$search}%")
            ->paginate('15');
        
        return view('complete.index', compact('service'));
    }

    

   public function finishService(Request $request, $no_service)
   {
       Auth::user();
       $this->validate($request,[
        'foto' => 'required'
        ]);
        $timezone = 'Asia/Jakarta';
        $date = new DateTime('now', new DateTimeZone($timezone));
        $tahun = $date->format('ym');
        $tanggal = $date->format('d');
        $tanggalterbit = $date->format('Y-m-d');
       
        $service = Service::find($no_service);

        if($request->hasFile('foto')){
            $serviceImg = ServiceImg::find($no_service);
            $file = $request->file('foto');
            $namafile = str_replace('','',$no_service.'-'.$service->nopol.'-'.'sesudah service');
            $tujuan = 'bukti-service';
            $file->move($tujuan,$namafile);
            $serviceImg->foto_after = $namafile;
        }
        $pool = substr($service->pool, 0, 3);
        $service->status = 'On Warranty';
        $invoice = new Invoice();

        $prefix = 'SCB-KLIKBENGKEL'.$service->area.'-'.$pool.$tahun.'-'.$tanggal;
        $kode_invoice = IdGenerator::generate(['table' => 'invoice', 'field' => 'no_invoice', 'reset_on_prefix_change' =>true, 'length' => 30, 'prefix' =>$prefix]);
        $invoice->no_invoice = $kode_invoice;
        $invoice->no_service = $service->no_service;
        $invoice->tanggal = $tanggalterbit;
        $invoice->subtotal = $service->subtotal;
        $invoice->ppn = $service->ppn;
        $invoice->area = $service->area;
        $invoice->witel = $service->witel;
        $invoice->pool = $service->pool;
        $invoice->total = $service->total;
        $area = Area::find($service->area);
        Mail::send('email.done', compact('area', 'service', 'invoice'), function($message) use ($area){
            $message->from(Auth::user()->email, Auth::user()->name);
            $message->to($area->user->email)->subject('Pemberitahuan Service Selesai');
        });
        
        $invoice->save();
        $service->save();
        $serviceImg->save();

        Alert::success('Berhasil', 'Anda telah berhasil menyelesaikan proses service anda.');
        return redirect()->back();
   }

   public function cancel($pool)
   {
       Auth::user();
       $service = Service::where('pool', $pool)->where('status', '!=', 'On Warranty')->where('status', '!=', 'Done')->orderBy('created_at', 'desc')->paginate(15);

       return view('req-service.cancel', compact('service'));
   }

   public function cancelDetail($no_service)
   {
       Auth::user();
       $service = Service::find($no_service);

       return view('req-service.cancel-detail', compact('service'));
   }

   public function canceled($no_service)
   {
       Auth::user();
       $service = Service::find($no_service);
       $service->status = 'Request Cancel';
       $service->save();

       $area = Area::find($service->area);

       Mail::send('email.cancelasman', compact('area', 'service'), function($message) use ($area){
        $message->from(Auth::user()->email, Auth::user()->name);
        $message->to($area->user->email)->subject('Permohonan Cancel Service');
        });

       Alert::success('Berhasil', 'Anda telah berhasil melakukan request cancel service');
       return redirect()->route('cancel.list', $service->pool);
   }

   public function approveCancel($kode_area)
   {
       Auth::user();
       $service = Service::where('area', $kode_area)->where('status', 'Request Cancel')->orderBy('created_at', 'desc')->paginate(15);

       return view('req-service.acc-cancel', compact('service'));
   }

   public function appCancelDetail($no_service)
   {
       Auth::user();
       $service = Service::find($no_service);

       return view('req-service.acc-detail', compact('service'));
   }

   public function appCancel($no_service)
    {
        $service = Service::find($no_service);
        $pool = Pool::find($service->pool);
        $service->status = 'Cancel';
        $timezone = 'Asia/Jakarta';
        $date = new DateTime('now', new DateTimeZone($timezone));
        $format = $date->format('ym');

        $kode = $pool->pool.$format;
        $budget = DistribusiBudget::find($kode);
        $budget_after = $budget->sisa_budget + $service->subtotal;
        $budget->sisa_budget = $budget_after;

        Mail::send('email.canceldisp', compact('pool', 'service'), function($message) use ($pool){
            $message->from(Auth::user()->email, Auth::user()->name);
            $message->to($pool->user->email)->subject('Hasil Approval Cancel');
        });
        $budget->save();
        $service->save();

        Alert::success('Berhasil', 'Anda telah berhasil melakukan approval cancel service');
        return redirect()->route('acc.cancel', Auth::user()->resp);
    }

    public function declineCancel($no_service)
    {
        $service = Service::find($no_service);
        $service->status = 'On Service';
        $pool = Pool::find($service->kendaraan->pool);
       
        Mail::send('email.canceldisp', compact('pool', 'service'), function($message) use ($pool){
            $message->from(Auth::user()->email, Auth::user()->name);
            $message->to($pool->user->email)->subject('Hasil Approval Cancel');
        });
        $service->save();

        Alert::success('Berhasil', 'Anda telah berhasil melakukan decline cancel service');
        return redirect()->route('acc.cancel', Auth::user()->resp);
    }

    public function filterHistory(Request $request)
    {
        Auth::user();
        $area = Area::all();
        $status = Service::distinct()->get('status');
        $areanya = $request->area;
        $statusnya = $request->status;
        $tgl_awal = $request->tgl_awal;
        // dd($tgl_awal);
        $tgl_akhir = $request->tgl_akhir;

        if($areanya != NULL && $statusnya != NULL){
            $service = Service::where('area', $areanya)->where('status', $statusnya)->paginate(150);
        }elseif($areanya == NULL){
            $service = Service::where('status', $statusnya)->paginate(150);
        }elseif($statusnya == NULL){
            $service = Service::where('area', $areanya)->paginate(150);
        }
       
        return view('hist-service.table', compact('service', 'area', 'status', 'areanya', 'statusnya', 'tgl_awal', 'tgl_akhir'));
    }

    public function historyGroup(Request $request)
    {
        Auth::user();

        $area = Area::all();
        

        return view('hist-service.group', compact('area', ));
    }

    public function searchHistoryDate(Request $request)
    {
        Auth::user();
        $kode_area = $request->kode_area;
        $tgl_awal = $request->tgl_awal;
        $tgl_akhir = $request->tgl_akhir;
        
        if($tgl_awal == NULL || $tgl_akhir == NULL){
            Alert::error('Gagal', 'Mohon Isi Tanggal');
            return redirect()->back();
        }
        $service = Service::where('area', 'like', $kode_area)->where('status', '!=', 'NULL')->whereBetween('tanggal', [$tgl_awal, $tgl_akhir])->get();
        $area = Area::where('kode_area', $kode_area)->get();
        // dd($area);
        $status = Service::distinct()->get('status');
        $areanya = $request->area;
        $statusnya = $request->status;
        
        return view('hist-service.table-date', compact('service', 'area', 'status', 'areanya', 'statusnya', 'tgl_awal', 'tgl_akhir', 'kode_area'));
    }

    public function exportHistory($kode_area, $tgl_awal, $tgl_akhir)
    {
        Auth::user();
        
        return Excel::download(new HistoryExport($kode_area, $tgl_awal, $tgl_akhir), 'History Service Area '.$kode_area.' From '. $tgl_awal. ' To '. $tgl_akhir.'.xlsx');
    }

    public function searchHistoryGsd(Request $request)
    {
        Auth::user();
        $tgl_awal = $request->tgl_awal;
        $tgl_akhir = $request->tgl_akhir;
        
        if($tgl_awal == NULL || $tgl_akhir == NULL){
            Alert::error('Gagal', 'Mohon Isi Tanggal');
            return redirect()->back();
        }

        $area = Area::all();
        $service = Service::where('status', '!=', 'NULL')->whereBetween('tanggal', [$tgl_awal, $tgl_akhir])->get();
        $status = Service::whereNotNull('status')->distinct()->get('status');
        $areanya = $request->area;
        $statusnya = $request->status;
        
        return view('hist-service.table-dategsd', compact('service', 'area','status', 'areanya', 'statusnya', 'tgl_awal', 'tgl_akhir'));
    }

    public function exportHistoryGsd($tgl_awal, $tgl_akhir)
    {
        Auth::user();
        
        return Excel::download(new HistoryExportGsd($tgl_awal, $tgl_akhir), 'History Service From '. $tgl_awal. ' To '. $tgl_akhir.'.xlsx');
    }
}
