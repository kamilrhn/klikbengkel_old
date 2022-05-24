<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $kendaraan = Kendaraan::all();
        dd($kendaraan);
        return view('dashboard');
    }

    public function maint()
    {
        return view('404');
    }
}
