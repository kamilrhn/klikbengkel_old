<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Invoice;
use App\Models\Area;
use App\Models\Service;
use App\Models\ServiceDetail;
use PDF;

class InvoiceController extends Controller
{
    //
    public function index(Request $request)
    {
        $invoice = Invoice::paginate(10);
        $area = Area::all();
        $areanya = $request->area;
        return view('invoice.list', compact('invoice', 'area', 'areanya'));
    }

    public function indexArea($kode_area)
    {
        $invoice = Invoice::where('area', $kode_area)->paginate(10);
        return view('invoice.list', compact('invoice'));
    }

    public function invPdf($no_invoice)
    {
        $invoice = Invoice::find($no_invoice);
        $pdf = PDF::loadview('invoice.inv-pdf', ['invoice' => $invoice]);
        
        return view('invoice.inv-pdf', compact('invoice'));
    }

    public function filterInvoice(Request $request)
    {
        Auth::user();
        $area = Area::all();
        $areanya = $request->area;
        $invoice = Invoice::where('area', $areanya)->paginate(10);
       
        return view('invoice.list', compact('invoice', 'area', 'areanya'));
    }
    
    public function getlistPayment($pool)
    {
        Auth::user();
        $service = Service::where('pool', $pool)->where('status', 'On Warranty')->paginate(15);

        return view('invoice.listPayment', compact('service'));
    }
}
