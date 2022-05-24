<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bengkel;
use Illuminate\Support\Facedas\DB;
use Illuminate\Support\Facedas\Auth;

class BengkelController extends Controller
{
   //
   public function tambahBengkel()
   {
       return view('create.bengkel');
   }

   public function store(Request $request)
   {
       Auth::user();

      $request->validate([
        'witel' => 'required',
        'nama_bengkel' => 'required',
        'alamat' => 'required',
      ]);

      $bengkel = new Bengkel();
      $bengkel->witel = $request -> witel;
      $bengkel->r2_r4 = $request -> r2_r4;
      $bengkel->nama_bengkel = $request -> nama_bengkel;
      $bengkel->alamat = $request -> alamat;
      $bengkel->no_telp = $request -> no_telp;
      $bengkel->pic = $request -> pic;
      $bengkel->url = $request -> url;

      return redirect('bengkel');
   }

   public function update(Request $request, Bengkel $bengkel)
    {
        Auth::user();
    
        $bengkel->witel = $request -> witel;
        $bengkel->r2_r4 = $request -> r2_r4;
        $bengkel->nama_bengkel = $request -> nama_bengkel;
        $bengkel->alamat = $request -> alamat;
        $bengkel->no_telp = $request -> no_telp;
        $bengkel->pic = $request -> pic;
        $bengkel->url = $request -> url;

        return redirect('bengkel');
    }

    public function edit(Bengkel $bengkel)
    {
        Auth::user();

        return view('edit.bengkel');
    }

    public function destroy(Bengkel $bengkel)
    {
        Auth::user();

        $bengkel->delete();

        return redirect('bengkel');
    }

}
