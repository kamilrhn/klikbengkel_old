<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Kendaraan;
use App\Models\Area;
use App\Models\Witel;
use App\Models\Pool;
use App\Models\Bengkel;
use App\Models\Service;
use App\Models\Nonkhs;
use Excel;
use App\Exports\NonkhsExport;
use Yajra\Datatables\Datatables;

class ManageController extends Controller
{
    //
    public function dataKendaraan(Request $request)
    {
        $areaSelect = $request->input('area');
        // dd($areaSelect);
        $witelSelect = $request->input('witel');
        $poolSelect = $request->input('pool');
        $area = Area::all();
        $witel = Witel::all();
        $pool = Pool::all();
        $kendaraan = Kendaraan::orderBy('area', 'asc')->paginate(25);
        return view('manage.kendaraan', compact('kendaraan', 'area', 'witel', 'pool', 'areaSelect', 'witelSelect', 'poolSelect'));
    }

    public function findKendaraan(Request $request){
        $areaSelect = $request->input('area');
        // dd($areaSelect);
        $witelSelect = $request->input('witel');
        $poolSelect = $request->input('pool');
        $area = Area::all();
        $witel = Witel::all();
        $pool = Pool::all();
        if($areaSelect != NULL && $witelSelect != NULL && $poolSelect != NULL){
            $kendaraan = Kendaraan::query()
                    ->where('area', $areaSelect)->where('witel', $witelSelect)->where('pool', $poolSelect)->paginate(50);
        }elseif($witelSelect == NULL && $poolSelect == NULL){
            $kendaraan = Kendaraan::query()
                    ->where('area', $areaSelect)->paginate(50);
        }elseif($poolSelect == NULL){
            $kendaraan = Kendaraan::query()
                    ->where('area', $areaSelect)->where('witel', $witelSelect)->paginate(50);
        }
        
        return view('manage.kendaraan', compact('kendaraan', 'area', 'witel', 'pool', 'areaSelect', 'witelSelect', 'poolSelect'));
    }

    public function dataKendaraanArea($kode_area)
    {
        $area = Area::all();
        $witel = Witel::all();
        $pool = Pool::all();
        $kendaraan = Kendaraan::where('area', $kode_area)->orderBy('area', 'asc')->paginate(25);
        return view('manage.kendaraanarea', compact('kendaraan', 'area', 'witel', 'pool'));
    }

    public function dataKendaraanPool($pool1)
    {
        $area = Area::all();
        $witel = Witel::all();
        $pool = Pool::all();
        $kendaraan = Kendaraan::where('pool', $pool1)->orderBy('area', 'asc')->paginate(25);

        return view('manage.kendaraanpool', compact('kendaraan', 'area', 'witel', 'pool'));
    }

    public function cariKendaraan(Request $request)
    {
        $search = $request->input('search');

        $area = Area::all();
        $witel = Witel::all();
        $pool = Pool::all();
        $kendaraan = Kendaraan::query()
            ->where('nopol', 'LIKE', "%{$search}%")
            ->orWhere('area', 'LIKE', "%{$search}%")
            ->orWhere('witel', 'LIKE', "%{$search}%")
            ->orWhere('pool', 'LIKE', "%{$search}%")
            ->orWhere('merk', 'LIKE', "%{$search}%")
            ->orWhere('type', 'LIKE', "%{$search}%")
            ->orWhere('kepemilikan', 'LIKE', "%{$search}%")
            ->paginate('25');
        
        return view('manage.kendaraan', compact('kendaraan', 'area', 'witel', 'pool'));
    }

    public function dataArea()
    {
        $area = Area::all();

        return view('manage.area', compact('area'));
    }

    public function dataBengkel()
    {
        $bengkel = Bengkel::orderBy('nama_bengkel', 'asc')->paginate('25');

        return view('manage.bengkel', compact('bengkel'));
    }

    public function dataBengkelArea($kode_area)
    {
        $bengkel = Bengkel::where('area', $kode_area)->orderBy('nama_bengkel', 'asc')->paginate('25');

        return view('manage.bengkelarea', compact('bengkel'));
    }

    public function dataBengkelPool($pool)
    {
        $bengkel = Bengkel::where('pool', $pool)->orderBy('nama_bengkel', 'asc')->paginate('25');

        return view('manage.bengkelpool', compact('bengkel'));
    }

    public function nonKhsAdmin()
    {
        Auth::user();
        $nonkhs = Nonkhs::paginate('15');

        return view('manage.nonkhs', compact('nonkhs'));
    }

    public function dataNonkhs($kode_area)
    {
        $nonkhs = Nonkhs::where('area', $kode_area)->paginate('25');
        
        return view('manage.nonkhs', compact('nonkhs'));
    }

    public function excelNonkhs($kode_area)
    {
//         $nonkhs = Nonkhs::where('area', $kode_area)->get()->toArray();
//         $data_array[] = array('Area', 'Nama Service/Part', 'Harga');
// dd($nonkhs);
//         foreach($nonkhs as $n){
//             $data_array[] = array(
//                 'Area' => $n->area,
//                 'Nama Service/Part' => $n->nama,
//                 'Harga' => $n->harga
//             );
//             dd($data_array);
//         }

//         Excel::create('export-to-excel', function($excel) use ($data_array){
//             $excel->setTitle('Data Service/Part Non KHS');
//             $excel->sheet('Data Service/Part Non KHS', function($sheet) use ($data_array){
//                 $sheet->fromArray($data_array, null, 'A1', false, false);
//             });
//         })->export('csv');
        
        return Excel::download(new NonkhsExport, 'Data Non KHS.xlsx');
    }

    public function cariBengkel(Request $request)
    {
        $search = $request->input('search');

        $bengkel = Bengkel::query()
            ->where('witel', 'LIKE', "%{$search}%")
            ->orWhere('nama_bengkel', 'LIKE', "%{$search}%")
            ->paginate('25');
        
        return view('manage.bengkel', compact('bengkel'));
    }

    public function getNopolService($kode_area)
    {
        if(request()->ajax()){
            $data = Kendaraan::where('area', $kode_area)->whereHas('service')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="'.route('manage.servicedetail', $row->nopol).'" class="edit btn btn-success btn-sm">Detail</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('manage.service');

    }

    public function getDetail($nopol)
    {
        $kendaraan = Kendaraan::find($nopol);
		$service = Service::where('nopol', $nopol)->get();

        return view('manage.servicedetail', compact('kendaraan', 'service'));
    }

}
