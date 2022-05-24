@extends('layouts.app')
@section('content')
@include('sweetalert::alert')
@include('layouts.headers.payment')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('assets') }}/vendor/dropzone/dist/min/dropzone.min.js"></script>
<div class="container-fluid mt--7">
    <div class="row mb-4">
       <div class="col-6">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="mb-0">Detail Service</h3>
                </div>
                <div class="table-responsive px-2 py-2">
                  <table class="table table-bordered mb-2" style="width=100%;">
                     <thead>
                        <tr class="teal darken-1 white-text text-center" style="color:white;font-weight:bolder;background-color:#565656">
                           <th colspan="4">DETAIL SERVICE KHS</th>
                        </tr>
                        <tr class="teal darken-1 white-text text-center" style="color:white;font-weight:bolder;background-color:#565656">
                           {{-- <th width="5%">Action</th>    --}}
                           <th width="40%">Deskripsi</th>
                           <th width="15%">Qty</th>
                           <th width="20%">Harga</th>
                           <th width="20%">Subtotal</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($rinciankhs as $r)
                        <tr class="text-center">
                           {{-- <th width="5%"><a href="{{route('delete.rincian', $r->id)}}" onclick="return confirm('YAKIN HAPUS RINCIAN SERVICE?')" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a></th>    --}}
                           <td width="40%">{{$r->keterangan}}</td>
                           <td width="15%">{{$r->qty}}</td>
                           <td width="20%">{{number_format($r->harga)}}</td>
                           <td width="20%">{{number_format($r->subtotal)}}</td>
                        </tr>
                        @endforeach
                     </tbody>
                     <tfoot>
                        <tr class="teal darken-1 white-text text-center" style="color:white;font-weight:bolder;background-color:#808080">
                           <th colspan="3">Total</th>
                           <th>{{number_format($totalkhs)}}</th>
                        </tr>
                     </tfoot>
                  </table>
                  <table class="table table-bordered mb-2" style="width=100%;">
                     <thead>
                        <tr class="teal darken-1 white-text text-center" style="color:white;font-weight:bolder;background-color:#565656">
                           <th colspan="4">DETAIL SERVICE NON KHS</th>
                        </tr>
                        <tr class="teal darken-1 white-text text-center" style="color:white;font-weight:bolder;background-color:#565656">
                           {{-- <th width="5%">Action</th>    --}}
                           <th width="40%">Deskripsi</th>
                           <th width="15%">Qty</th>
                           <th width="20%">Harga</th>
                           <th width="20%">Subtotal</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($rinciannon as $r)
                        <tr class="text-center">
                           {{-- <th width="5%"><a href="#" onclick="return confirm('YAKIN HAPUS RINCIAN SERVICE?')" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a></th>    --}}
                           <td width="40%">{{$r->keterangan}}</td>
                           <td width="15%">{{$r->qty}}</td>
                           <td width="20%">{{number_format($r->harga)}}</td>
                           <td width="20%">{{number_format($r->subtotal)}}</td>
                        </tr>
                        @endforeach
                     </tbody>
                     <tfoot>
                        <tr class="teal darken-1 white-text text-center" style="color:white;font-weight:bolder;background-color:#808080">
                           <th colspan="3">Total</th>
                           <th>{{number_format($totalnon)}}</th>
                        </tr>
                        <tr class="teal darken-1 white-text text-center" style="color:white;font-weight:bolder;background-color:#808080">
                           <th colspan="3">PPn(10%)</th>
                           <th>{{number_format($payment->service->ppn)}}</th>
                        </tr>
                     </tfoot>
                   </table>
                    <table class="table table-bordered" style="width=80%;">
                       <thead>
                          <tr class="teal darken-1 white-text text-center" style="color:white;font-weight:bolder;background-color:#565656">
                             <th colspan="4">TOTAL PEMBAYARAN SERVICE {{$payment->service->no_service}}</th>
                          </tr>
                          <tr class="teal darken-1 white-text text-center" style="color:white;font-weight:bolder;background-color:#565656">
                             <th width="40%">Deskripsi</th>
                             <th width="20%">Total</th>
                             <th width="20%">PPn</th>
                             <th width="20%">Grand Total</th>
                          </tr>
                       </thead>
                       <tbody>
                          <tr class="text-center">
                             <td width="40%">Grand Total Service KHS</td>
                             <td width="20%">{{number_format($totalkhs)}}</td>
                             <td width="20%">0</td>
                             <td width="20%">{{number_format($totalkhs)}}</td>
                          </tr>
                          <tr class="text-center">
                             <td width="40%">Grand Total Service Non KHS</td>
                             <td width="20%">{{number_format($totalnon)}}</td>
                             <td width="20%">{{number_format($payment->service->ppn)}}</td>
                             <td width="20%">{{number_format($totalnon + $payment->service->ppn)}}</td>
                          </tr>
                       </tbody>
                       <tfoot>
                          <tr class="teal darken-1 white-text text-center" style="color:white;font-weight:bolder;background-color:#808080">
                             <th colspan="3">Total</th>
                             <th>{{number_format($payment->service->total)}}</th>
                          </tr>
                       </tfoot>
                    </table>
                 </div>
            </div>
       </div>
       <div class="col-6">
         <div class="card">
            <div class="card-header border-0">
               <h3 class="mb-0">Foto Nota Service</h3>
            </div>
            <div class="card-body" style="height:750px; ">
               <div class="card-title mb-4">
                  <h4>No. Polisi : {{ $payment->service->nopol }}</h4>
                  <h4>Nama Bengkel : {{ $payment->service->bengkel }}</h4>
                  <h4>Jenis Bengkel : {{ $payment->service->jenis_bengkel }}</h4>
               </div>
               <div class="dz-preview dz-preview-single mt-2">
                  <div class="dz-preview-cover">
                     @if($payment->service->foto != NULL)
                     <img src="{{asset('payment/'.$payment->file)}}" class="dz-preview-img"  id="previewImg" style="height:600px; width:550px;" data-dz-thumbnail>
                     @else
                     <img class="dz-preview-img"  id="previewImg" style="height:250px; width:400px;" data-dz-thumbnail>
                     @endif
                  </div>
               </div>
            </div>
         </div>
      </div>
    </div>
    <div class="row">
       <div class="col">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="mb-0">Detail Payment</h3>
                </div>
                <div class="card-body text-center border-0">
                    <h4 class="mb-0">Mohon Melakukan Pembayaran No. Service {{ $payment->service->no_service }} ke:</h4>
                    <ul class="list-unstyled  mt-4">
                        <li><h3><i class="far fa-credit-card text-red"></i> : {{ $payment->nama_bank }} {{ $payment->no_rekening }} an. {{ $payment->nama_rekening }}</h3></li>
                        <li><h3><i class="fas fa-money-bill-wave text-red"></i> : Rp. {{ number_format($payment->nominal_nota) }}</h3></li>
                    </ul>
                </div>
                <div class="card-footer py-4">
                    <nav aria-label="...">
                        <div class="float-sm-right">
                            <ul class="pagination mb-0">
                                <li class="page-item">
                                   
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
       </div>
    </div>
    <div class="row mt-4">
      <div class="col-12">
         @if($payment->status != 'Accepted')
         <div class="float-right">
            <a href="{{route('payment.decline', $payment->kode_bayar)}}" style="color:white;" class="btn btn-danger">Decline</a>
            <a href="{{ route('payment.approve', $payment->kode_bayar) }}"  style="color:white;" class="btn btn-success">Approve</a>
         </div>
         @endif
      </div>
   </div>
    @include('layouts.footers.auth')
</div>

@endsection