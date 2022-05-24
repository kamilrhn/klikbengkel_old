<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Invoice;
use App\Models\Area;
use App\Models\Service;
use App\Models\Payment;
use App\Models\Pool;
use App\Models\ServiceDetail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Mail\KlikbengkelMail;
use Illuminate\Support\Facades\Mail;
use PDF;

class PaymentController extends Controller
{
    //
    public function getlistPayment($pool)
    {
        Auth::user();
        $service = Service::where('pool', $pool)->where('status', 'On Warranty')->orderBy('tanggal', 'desc')->paginate(100);

        return view('payment.listPayment', compact('service'));
    }

    public function getDetailPayment($kode_bayar)
    {
        Auth::user();
        $payment = Payment::find($kode_bayar);

        $rinciankhs = ServiceDetail::where('no_service', $payment->no_service)->where('kategori', 'khs')->get();
        $totalkhs = $rinciankhs->sum('subtotal');
        $rinciannon = ServiceDetail::where('no_service', $payment->no_service)->where('kategori', 'non')->get();
        $totalnon = $rinciannon->sum('subtotal');

        return view('payment.detailpayment', compact('payment', 'totalkhs', 'totalnon', 'rinciankhs', 'rinciannon'));
    }

    public function getPaymentApproval()
    {
        Auth::user();
        $service = Service::where('status', 'Waiting Payment Approval')->paginate(100);

        return view('payment.paymentApproval', compact('service'));
    }

    public function getPaymentAccept()
    {
        Auth::user();
        $service = Service::where('status', 'Payment Accept')->paginate(15);

        return view('payment.paymentAccept', compact('service'));
    }

    public function getPaidPayment($pool)
    {
        Auth::user();
        $service = Service::where('pool', $pool)->where('status', 'Paid')->paginate(15);
       

        return view('payment.paid', compact('service'));   
    }

    public function storePayment(Request $request)
    {
        Auth::user();
        $this->validate($request,[
            'nominal_nota' => 'required',
            'nama_rekening' => 'required',
            'no_rekening' => 'required',
            'nama_bank' => 'required',
            'file' => 'required'
        ]);

        $no_service = $request->no_service;
        $service = Service::find($no_service);

        $kode_bayar = 'Payment_'.$no_service;
        $payment = new Payment();
        $payment->kode_bayar = $kode_bayar;
        $payment->no_service = $no_service;
        $payment->nominal_service = $service->total;
        $payment->nominal_nota = $request->nominal_nota;
        $payment->profit = $payment->nominal_service - $payment->nominal_nota;
        $payment->nama_rekening = $request->nama_rekening;
        $payment->no_rekening = $request->no_rekening;
        $payment->nama_bank = $request->nama_bank;
        $payment->status = 'Request';
        $service->status = 'Waiting Payment Approval';
        // dd($payment);
        if($request->hasFile('file')){
            $file = $request->file('file');
            $namafile = str_replace('','',$kode_bayar.'-'.$service->nopol.'-'.'Nota Dispatcher');
            $tujuan = 'payment';
            $file->move($tujuan,$namafile);
            $payment->file = $namafile;
        }
        // dd($payment);
        $service->save();
        $payment->save();

        Alert::success('Berhasil', 'Anda telah berhasil melakukan permohonan pembayaran');
        return redirect()->back();
    }

    public function storePaid(Request $request)
    {
        Auth::user();
        $payment = Payment::find($request->kode_bayar);
        // dd($payment);

        $service = Service::find($payment->no_service);
        $service->status = 'Paid';
// dd($request);
        $payment->status = 'Paid';
        if($request->hasFile('file')){
            $file = $request->file('file');
            $namafile = str_replace('','',$payment->kode_bayar.'-'.$service->nopol.'-'.'Bukti Payment');
            $tujuan = 'payment';
            $file->move($tujuan,$namafile);
            $payment->proof = $namafile;
        }
        $payment->notes = $request->notes;
        // dd($payment);
        $payment->save();
        $service->save();

        Alert::success('Berhasil', 'Anda telah berhasil melakukan permohonan pembayaran');
        return redirect()->back();
    }

    public function approvePayment($kode_bayar)
    {
        Auth::user();

        $payment = Payment::find($kode_bayar);
        $service = Service::find($payment->no_service);
        $pool = Pool::findOrFail($service->pool);
        // dd($pool);

        try{
            Mail::send('email.approvalPayment', compact('pool', 'payment'), function($message) use ($pool){
                $message->from(Auth::user()->email, Auth::user()->name);
                $message->to($pool->user->email)->subject('Info Payment');
            });
        }catch(exception $e){
            return response ($e->getMessage(), 422);
        }

        $payment->status = 'Accepted';
        $service->status = 'Payment Accept';
        // dd($payment);    
        $payment->save();
        $service->save();

        return redirect()->route('payment.approval');
        Alert::success('Berhasil', 'Anda telah berhasil melakukan approval payment');
        
    }

    public function declinePayment($kode_bayar)
    {
        Auth::user();

        $payment = Payment::find($kode_bayar);
        $service = Service::find($payment->no_service);
        $pool = Pool::findOrFail($service->pool);
        
        $service->status = 'On Warranty';
        try{
            Mail::send('email.declinePayment', compact('pool', 'payment'), function($message) use ($pool){
                $message->from(Auth::user()->email, Auth::user()->name);
                $message->to($pool->user->email)->subject('Info Payment');
            });
        }catch(exception $e){
            return response ($e->getMessage(), 422);
        }

        dd($service);
        $service->save();
        $payment->delete();

        return redirect()->route('payment.approval');
        Alert::success('Berhasil', 'Anda telah berhasil melakukan decline payment');
        
    }
    
}
