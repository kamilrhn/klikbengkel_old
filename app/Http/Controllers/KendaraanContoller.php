<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Kendaraan;

use Illuminate\Http\Request;

class KendaraanContoller extends Controller
{
    //
    public function tambahKendaraan()
    {
        return view ('create.kendaraan');
    }
        
    public function store(Request $request)
    {
        $request->validate([
            'nopol' => 'required',
            'status_nopol' => 'required',
            'area' => 'required',
            'witel' => 'required',
            'pool' => 'required',
        ]);

      $kendaraan = new Kendaraan();
      $kendaraan->nopol = $request -> nopol;
      $kendaraan->status_nopol = $request -> status_nopol;
      $kendaraan->area = $request -> area;
      $kendaraan->aktivasi = $request -> aktivasi;
      $kendaraan->dispatcher = $request -> dispatcher;
      $kendaraan->witel = $request -> witel;
      $kendaraan->pool = $request -> pool;
      $kendaraan->jenis = $request -> jenis;
      $kendaraan->merk = $request -> merk;
      $kendaraan->type = $request -> type;
      $kendaraan->tahun = $request -> tahun;
      $kendaraan->status = $request -> status;
      $kendaraan->ketersediaan = $request -> ketersediaan;
      $kendaraan->bbm = $request -> bbm;
      $kendaraan->km = $request -> km;
      $kendaraan->ms_nms = $request -> ms_nms;
      $kendaraan->kepemilikan = $request -> kepemilikan;
      $kendaraan->r2_r4 = $request -> r2_r4;
      $kendaraan->lokasi_kbm = $request -> lokasi_kbm;
      $kendaraan->warna = $request -> warna;
      $kendaraan->no_rangka = $request -> no_rangka;
      $kendaraan->no_mesin = $request -> no_mesin;
      $kendaraan->customers = $request -> customers;
      $kendaraan->branding = $request -> branding;
      $kendaraan->nama_bengkel = $request -> nama_bengkel;

      return redirect('kendaraan');
    }

    public function update(Request $request, Kendaraan $kendaraan)
    {
        Auth::user();
    
        $kendaraan->nopol = $request -> nopol;
        $kendaraan->status_nopol = $request -> status_nopol;
        $kendaraan->area = $request -> area;
        $kendaraan->aktivasi = $request -> aktivasi;
        $kendaraan->dispatcher = $request -> dispatcher;
        $kendaraan->witel = $request -> witel;
        $kendaraan->pool = $request -> pool;
        $kendaraan->jenis = $request -> jenis;
        $kendaraan->merk = $request -> merk;
        $kendaraan->type = $request -> type;
        $kendaraan->tahun = $request -> tahun;
        $kendaraan->status = $request -> status;
        $kendaraan->ketersediaan = $request -> ketersediaan;
        $kendaraan->bbm = $request -> bbm;
        $kendaraan->km = $request -> km;
        $kendaraan->ms_nms = $request -> ms_nms;
        $kendaraan->kepemilikan = $request -> kepemilikan;
        $kendaraan->r2_r4 = $request -> r2_r4;
        $kendaraan->lokasi_kbm = $request -> lokasi_kbm;
        $kendaraan->warna = $request -> warna;
        $kendaraan->no_rangka = $request -> no_rangka;
        $kendaraan->no_mesin = $request -> no_mesin;
        $kendaraan->customers = $request -> customers;
        $kendaraan->branding = $request -> branding;
        $kendaraan->nama_bengkel = $request -> nama_bengkel;
  

        return redirect('kendaraan');
    }

    public function show(Kendaraan $kendaraan)
    {
    }

    public function edit(Kendaraan $kendaraan)
    {
        return view('user.edit', $kendaraan);
    }

    public function destroy(Kendaraan $kendaraan)
    {
        Auth::user();

        $kendaraan->delete();

        return redirect('kendaraan');
    }
}
