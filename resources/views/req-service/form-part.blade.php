@extends('layouts.app')
@section('content')
@include('sweetalert::alert')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('assets') }}/vendor/dropzone/dist/min/dropzone.min.js"></script>
<script>
   $(function() {
    $('input[name="selectBengkel"]').on('click', function() {
      if ($(this).val() == 'rekanan') {
            $("#rekananText").show();
            $("#nonrekananText").hide();
        }
        else {
            $("#rekananText").hide();
            $("#nonrekananText").show();
         }
   
      });
   });
   $(function() {
    $('input[name="selectService"]').on('click', function() {
      if ($(this).val() == 'berkala') {
            $("#berkalaSelect").show();
            $("#partSelect").hide();
        }
        else {
            $("#berkalaSelect").hide();
            $("#partSelect").show();
         }
   
      });
   });
</script>
@include('layouts.headers.requestService')
<div class="container-fluid mt--7">
   <div class="row">
      <div class="col-xl-12">
         <div class="card">
            <div class="card-header">
               <div class="row align-items-center">
                  <div class="col-6">
                     <h3 class="mb-0">Informasi Kendaraan </h3>
                  </div>
                  <div class="col-6">
                     <div class="float-right">
                        <a href="{{route('delete.request', $service->no_service)}}" onclick="return confirm('YAKIN BATAL REQUEST SERVICE?')" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Batalkan Request</a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <form action="{{ route('update.servicepart', $service->no_service) }}" method="post" enctype="multipart/form-data">
               {{csrf_field()}}
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <label class="form-control-label" for="input-address">No. Service</label>
                           <input id="vehicle" type="text" class="form-control" placeholder="Type to Search Nopol (ex: B1234ABC)" value="{{$service->no_service}}" readonly>
                        </div>
                        <div class="form-group">
                           <label class="form-control-label" for="input-address">Nopol</label>
                           <input id="vehicle" type="text" class="form-control" placeholder="Type to Search Nopol (ex: B1234ABC)" value="{{$service->nopol}}" readonly>
                        </div>
                        <div class="form-group">
                           <div class="row">
                              <div class="col-lg-6">
                                 <label class="form-control-label" for="input-city">Area</label>
                                 <input type="number" name="area" id="input-city" class="form-control" value="{{$kendaraan->area}}" readonly>
                              </div>
                              <div class="col-lg-6">
                                 <label class="form-control-label" for="input-city">Witel</label>
                                 <input type="text" name="witel" id="input-city" class="form-control" placeholder="Odoometer" value="{{$kendaraan->witel}}" readonly>
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="row">
                              <div class="col-lg-6">
                                 <label class="form-control-label" for="input-city">Pool</label>
                                 <input type="text" name="pool" id="input-city" class="form-control" value="{{$kendaraan->pool}}" readonly>
                              </div>
                              <div class="col-lg-6">
                                 <label class="form-control-label" for="input-city">Dispatcher</label>
                                 <input type="text" id="input-city" class="form-control" placeholder="Odoometer" value="{{$kendaraan->dispatcher}}" readonly>
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="row">
                              <div class="col-lg-6">
                                 <label class="form-control-label" for="input-city">Tahun</label>
                                 <input type="number" id="input-city" class="form-control" value="{{$kendaraan->tahun}}" readonly>
                              </div>
                              <div class="col-lg-6">
                                 <label class="form-control-label" for="input-city">Tanggal Service</label>
                                 <input type="date" id="input-city" class="form-control" value="{{$service->tanggal}}" readonly><label class="form-check-label" style ="font-size:12px;color:red;" for="input-city">Last Service Date : {{$kendaraan->last_service}}</label><br>
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="row">
                              <div class="col-lg-6">
                                 <label class="form-control-label" for="input-address">No. Rangka</label>
                                 <input id="vehicle" type="text" class="form-control" placeholder="Type to Search Nopol (ex: B1234ABC)" value="{{$kendaraan->no_rangka}}" readonly>
                              </div>
                              <div class="col-lg-6">
                                 <label class="form-control-label" for="input-address">No. Mesin</label>
                                 <input id="vehicle" type="text" class="form-control" placeholder="Type to Search Nopol (ex: B1234ABC)" value="{{$kendaraan->no_mesin}}" readonly>
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="row">
                              <div class="col-lg-6">
                                 <label class="form-control-label" for="input-address">Merk Kendaraan</label>
                                 <input id="vehicle" type="text" class="form-control" placeholder="Type to Search Nopol (ex: B1234ABC)" value="{{$kendaraan->merk}} {{$kendaraan->type}}" readonly>
                              </div>
                              <div class="col-lg-6">
                                 <label class="form-control-label" for="input-address">Warna</label>
                                 <input id="vehicle" type="text" class="form-control" placeholder="Type to Search Nopol (ex: B1234ABC)" value="{{$kendaraan->warna}}" readonly>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row mt-2">
      <div class="col-xl-12">
         <div class="card">
            <div class="card-header">
               <div class="row align-items-center">
                  <div class="col-6">
                     <h3 class="mb-0">Pilihan Bengkel </h3>
                  </div>
                  <div class="col-6">
                     <div class="float-sm-right">
                        @if($service->bengkel == NULL)
                        <a href="#" data-toggle="modal" data-target="#exampleModal3" class="btn btn-sm btn-info" style="background-color:#808080;">Pilih Jenis Bengkel</a>
                        @endif
                     </div>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-bordered" style="width=100%;">
                     <thead>
                        <tr class="teal darken-1 white-text text-center" style="color:white;font-weight:bolder;background-color:#565656">
                           <th colspan="5">DETAIL BENGKEL</th>
                        </tr>
                        <tr class="teal darken-1 white-text text-center" style="color:white;font-weight:bolder;background-color:#565656">
                           <th width="10%">Action</th>   
                           <th width="45%">Jenis Bengkel</th>
                           <th width="45%">Nama Bengkel</th>
                        </tr>
                     </thead>
                     <tbody>
                        @if($service->jenis_bengkel != NULL)
                        <tr class="text-center">
                           <th width="5%"><a href="#" onclick="return confirm('YAKIN HAPUS RINCIAN SERVICE?')" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a></th>
                           @if($service->jenis_bengkel == 'rekanan')   
                           <td width="40%">Bengkel Rekanan</td>
                           @else
                           <td width="40%">Bengkel Non Rekanan</td>
                           @endif
                           <td width="15%">{{$service->bengkel}}</td>
                        </tr>
                        @endif
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row mt-2">
      <div class="col-xl-12">
         <div class="card">
            <div class="card-header">
               <div class="row align-items-center">
                  <div class="col-6">
                     <h3 class="mb-0">Pilihan Service KHS</h3>
                  </div>
                  <div class="col-6">
                     <div class="float-sm-right">
                        <!-- <a href="#" data-toggle="modal" data-target="#exampleModal2" class="btn btn-sm btn-info" style="background-color:#808080;">Tambah Service Non KHS</a> -->
                        <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-info" style="background-color:#808080;">Tambah Part</a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-bordered" style="width=100%;">
                     <thead>
                        <tr class="teal darken-1 white-text text-center" style="color:white;font-weight:bolder;background-color:#565656">
                           <th colspan="5">DETAIL SERVICE</th>
                        </tr>
                        <tr class="teal darken-1 white-text text-center" style="color:white;font-weight:bolder;background-color:#565656">
                           <th width="5%">Action</th>   
                           <th width="40%">Deskripsi</th>
                           <th width="15%">Qty</th>
                           <th width="20%">Harga</th>
                           <th width="20%">Subtotal</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($rinciankhs as $r)
                        <tr class="text-center">
                           <th width="5%"><a href="{{route('delete.rincian', $r->id)}}" onclick="return confirm('YAKIN HAPUS RINCIAN SERVICE?')" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a></th>   
                           <td width="40%">{{$r->keterangan}}</td>
                           <td width="15%">{{$r->qty}}</td>
                           <td width="20%">{{number_format($r->harga)}}</td>
                           <td width="20%">{{number_format($r->subtotal)}}</td>
                        </tr>
                        @endforeach
                     </tbody>
                     <tfoot>
                        <tr class="teal darken-1 white-text text-center" style="color:white;font-weight:bolder;background-color:#808080">
                           <th colspan="4">Total</th>
                           <th>{{number_format($totalkhs)}}</th>
                        </tr>
                        <tr class="teal darken-1 white-text text-center" style="color:white;font-weight:bolder;background-color:#808080">
                           <th colspan="4">Grand Total KHS</th>
                           <th>{{number_format($totalkhs)}}</th>
                        </tr>
                     </tfoot>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row mt-2">
      <div class="col-xl-12">
         <div class="card">
            <div class="card-header">
               <div class="row align-items-center">
                  <div class="col-6">
                     <h3 class="mb-0">Pilihan Service Non KHS</h3>
                  </div>
                  <div class="col-6">
                     <div class="float-sm-right">
                        <a href="#" data-toggle="modal" data-target="#exampleModal2" class="btn btn-sm btn-info" style="background-color:#808080;">Tambah Service Non KHS</a>
                        <!-- <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-info" style="background-color:#808080;">Tambah Service</a> -->
                     </div>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-bordered" style="width=100%;">
                     <thead>
                        <tr class="teal darken-1 white-text text-center" style="color:white;font-weight:bolder;background-color:#565656">
                           <th colspan="5">DETAIL SERVICE</th>
                        </tr>
                        <tr class="teal darken-1 white-text text-center" style="color:white;font-weight:bolder;background-color:#565656">
                           <th width="5%">Action</th>   
                           <th width="40%">Deskripsi</th>
                           <th width="15%">Qty</th>
                           <th width="20%">Harga</th>
                           <th width="20%">Subtotal</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($rinciannon as $r)
                        <tr class="text-center">
                           <th width="5%"><a href="#" onclick="return confirm('YAKIN HAPUS RINCIAN SERVICE?')" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a></th>   
                           <td width="40%">{{$r->keterangan}}</td>
                           <td width="15%">{{$r->qty}}</td>
                           <td width="20%">{{number_format($r->harga)}}</td>
                           <td width="20%">{{number_format($r->subtotal)}}</td>
                        </tr>
                        @endforeach
                     </tbody>
                     <tfoot>
                        <tr class="teal darken-1 white-text text-center" style="color:white;font-weight:bolder;background-color:#808080">
                           <th colspan="4">Total</th>
                           <th>{{number_format($totalnon)}}</th>
                        </tr>
                        <tr class="teal darken-1 white-text text-center" style="color:white;font-weight:bolder;background-color:#808080">
                           <th colspan="4">PPn(10%)</th>
                           <th>{{number_format($service->ppn)}}</th>
                        </tr>
                        <tr class="teal darken-1 white-text text-center" style="color:white;font-weight:bolder;background-color:#808080">
                           <th colspan="4">Grand Total Non KHS</th>
                           <th>{{number_format($totalnon + $service->ppn)}}</th>
                        </tr>
                     </tfoot>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row mt-2">
      <div class="col-xl-12">
         <div class="card">
            <div class="card-header">
               <div class="row align-items-center">
                  <div class="col-6">
                     <h3 class="mb-0">Grand Total</h3>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-bordered" style="width=100%;">
                     <thead>
                        <tr class="teal darken-1 white-text text-center" style="color:white;font-weight:bolder;background-color:#565656">
                           <th colspan="4">TOTAL PEMBAYARAN SERVICE {{$service->no_service}}</th>
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
                           <td width="20%">{{number_format($service->ppn)}}</td>
                           <td width="20%">{{number_format($totalnon + $service->ppn)}}</td>
                        </tr>
                     </tbody>
                     <tfoot>
                        <tr class="teal darken-1 white-text text-center" style="color:white;font-weight:bolder;background-color:#808080">
                           <th colspan="3">Total</th>
                           <th>{{number_format($service->total)}}</th>
                        </tr>
                     </tfoot>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row mt-2">
      <div class="col-xl-12">
         <div class="card">
            <div class="card-header">
               <div class="row align-items-center">
                  <div class="col-8">
                     <h3 class="mb-0">Validasi Service</h3>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <div class="dropzone dropzone-single">
                  <div class="fallback">
                     <div class="form-group">
                        <label class="form-control-label" for="input-city">Odoometer*</label>
                        <input type="number" name="km" id="input-city" class="form-control" placeholder="Odoometer">
                        <label class="form-check-label" style ="font-size:12px;color:red;" for="input-city">Last Odoometer Service : {{$kendaraan->km}}, Selisih Odoometer Harus > {{$setting->km}}</label>
                     </div>
                     <div class="form-group">
                        <label class="form-control-label" for="input-city">Bukti Sebelum Service*</label>
                        <input type="file" name="foto" class="form-control" id="uploadImg">
                     </div>
                  </div>
                  <div class="dz-preview dz-preview-single mt-2">
                     <div class="dz-preview-cover">
                        <img class="dz-preview-img"  id="previewImg" style="height:250px; width:400px;" data-dz-thumbnail>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row mt-4">
      <div class="col-12">
         <div class="float-right">
            <button type="submit" class="btn btn-primary">SUBMIT</button>
         </div>
         </form>
      </div>
   </div>
   @include('layouts.footers.auth')
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Service</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form action="{{ route('store.part', $service->no_service) }}" method="POST" enctype="multipart/form-data">
            @csrf
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label class="form-control-label" for="input-city">Part*</label>
                        <input  value="" name="keterangan1" class="form-control" placeholder="Type to Search Sparpert.." list="listPart">
                           <datalist id="listPart" name="bengkel">
                              @foreach($stokpart as $sp)
                              <option value="{{$sp->kode}}">{{$sp->nama}}</option>
                              @endforeach
                           </datalist>
                        
                     </div>
                     <div class="form-group">
                        <label class="form-control-label" for="input-city">Qty*</label>
                        <input type="number" name="qty"  class="form-control" placeholder="Qty">
                     </div>
                  </div>
               </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Service</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="table-responsive">
               <table class="table table-bordered" width="100%">
                  <thead>
                     <tr class="teal darken-1 white-text text-center" style="color:white;font-weight:bolder;background-color:#565656">
                        <th colspan="4">Detail Pekerjaan Service</th>
                     </tr>
                     <tr class="teal darken-1 white-text text-center" style="color:white;font-weight:bolder;background-color:#565656">
                        <th width="25%">Nama Service</th>
                        <th width="25%">Nama Barang</th>
                        <th width="35%">Spesifikasi</th>
                        <th width="15%">Harga</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($stokservice as $s)
                     @foreach($s->rincianStok as $rs)
                     <tr class="text-center">
                        <td>{{$s->nama_service}}</td>
                        <td>{{$rs->nama_barang}}</td>
                        <td>{{$rs->spesifikasi}}</td>
                        <td>{{number_format($rs->harga)}}</td>
                     </tr>
                     @endforeach
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Service</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form action="{{ route('store.nonkhs', $service->no_service) }}" method="POST" enctype="multipart/form-data">
            @csrf
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label class="form-control-label" for="input-city">Nama Part/Service</label>
                        <input  value="" name="nama" type="text" class="form-control" placeholder="Nama Service">
                     </div>
                     <div class="form-group">
                        <label class="form-control-label" for="input-city">Harga</label>
                        <input type="number" name="harga"  class="form-control" placeholder="Harga">
                     </div>
                     <div class="form-group">
                        <label class="form-control-label" for="input-city">Qty</label>
                        <input type="number" name="qty"  class="form-control" placeholder="Qty">
                     </div>
                  </div>
               </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Bengkel</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form action="{{route('store.bengkel', $service->no_service)}}" method="POST" enctype="multipart/form-data">
            @csrf
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                           <label class="form-control-label" for="input-address">Jenis Bengkel*</label>
                           <div class="form-check"> 
                              <input class="form-check-input" type="radio" value="rekanan" name="selectBengkel" >
                              <label class="form-check-label" for="rekanan" style="font-size:14px;"> 
                              Bengkel Rekanan
                              </label>
                              
                           </div>
                           <div class="form-check">
                              <input class="form-check-input" type="radio" name="selectBengkel" value="nonrekanan">
                              <label class="form-check-label" for="nonrekanan" style="font-size:14px;"> 
                              Bengkel Non-Rekanan
                              </label>
                           </div>
                        </div>
                        <div class="form-group" id="rekananText" style="display:none;">
                           <label class="form-control-label" for="input-city">Nama Bengkel Rekanan*</label>
                           <input id="bengkel" value="" name="bengkel1" class="form-control" placeholder="Type to Search Bengkel.." list="datalistOptions">
                           <datalist id="datalistOptions" name="bengkel">
                              @foreach($bengkel as $b)
                              <option value="{{$b->nama_bengkel}}">{{$b->nama_bengkel}}</option>
                              @endforeach
                           </datalist>
                           <label class="form-check-label" style ="font-size:12px;color:red;" for="input-city">Rekomendasi Bengkel : {{$kendaraan->nama_bengkel}}</label>
                        </div>
                        <div class="form-group" id="nonrekananText" style="display:none;">
                           <label class="form-control-label" for="input-city">Nama*</label>
                           <input name="bengkel" type="text" id="input-city" class="form-control" placeholder="Nama Bengkel">
                        </div>
                  </div>
               </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   function readURL(input) {
       if (input.files && input.files[0]) {
           var reader = new FileReader();
           
           reader.onload = function (e) {
               $('#previewImg').attr('src', e.target.result);
           }
           reader.readAsDataURL(input.files[0]);
       }
   }
   $("#uploadImg").change(function(){
       readURL(this);
   });
</script>
@endsection