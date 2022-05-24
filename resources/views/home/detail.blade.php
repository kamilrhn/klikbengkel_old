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
@include('layouts.headers.detailService')
<div class="container-fluid mt--7">
   <div class="row">
      <div class="col-xl-12">
         <div class="card">
            <div class="card-header">
               <div class="row align-items-center">
                  <div class="col-8">
                     <h3 class="mb-0">Informasi Kendaraan </h3>
                  </div>
               </div>
            </div>
            <div class="card-body">
               @if($service->status != 'On Warranty' || $service->status != 'Done')
               <form action="{{ route('update.detail', $service->no_service) }}" method="post" enctype="multipart/form-data">
               @endif
                  @csrf
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
                                 <input type="number" name="area" id="input-city" class="form-control" value="{{$service->area}}" readonly>
                              </div>
                              <div class="col-lg-6">
                                 <label class="form-control-label" for="input-city">Witel</label>
                                 <input type="text" name="witel" id="input-city" class="form-control" placeholder="Odoometer" value="{{$service->witel}}" readonly>
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="row">
                              <div class="col-lg-6">
                                 <label class="form-control-label" for="input-city">Pool</label>
                                 <input type="text" name="pool" id="input-city" class="form-control" value="{{$service->pool}}" readonly>
                              </div>
                              <div class="col-lg-6">
                                 <label class="form-control-label" for="input-city">Dispatcher</label>
                                 <input type="text" id="input-city" class="form-control" placeholder="Odoometer" value="{{$service->kendaraan->dispatcher}}" readonly>
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="row">
                              <div class="col-lg-6">
                                 <label class="form-control-label" for="input-city">Tahun</label>
                                 <input type="number" id="input-city" class="form-control" value="{{$service->kendaraan->tahun}}" readonly>
                              </div>
                              <div class="col-lg-6">
                                 <label class="form-control-label" for="input-city">Odoometer*</label>
                                 @if($service->status != 'Waiting')
                                 <input type="number" name="km" id="input-city" class="form-control" value={{$service->km}} placeholder="Odoometer" readonly>
                                 @else
                                 <input type="number" name="km" id="input-city" class="form-control" value={{$service->km}} placeholder="Odoometer">
                                 @endif
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="row">
                              <div class="col-lg-6">
                                 <label class="form-control-label" for="input-address">No. Rangka</label>
                                 <input id="vehicle" type="text" class="form-control" placeholder="Type to Search Nopol (ex: B1234ABC)" value="{{$service->kendaraan->no_rangka}}" readonly>
                              </div>
                              <div class="col-lg-6">
                                 <label class="form-control-label" for="input-address">No. Mesin</label>
                                 <input id="vehicle" type="text" class="form-control" placeholder="Type to Search Nopol (ex: B1234ABC)" value="{{$service->kendaraan->no_mesin}}" readonly>
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="row">
                              <div class="col-lg-6">
                                 <label class="form-control-label" for="input-address">Merk Kendaraan</label>
                                 <input id="vehicle" type="text" class="form-control" placeholder="Type to Search Nopol (ex: B1234ABC)" value="{{$service->kendaraan->merk}} {{$service->kendaraan->type}}" readonly>
                              </div>
                              <div class="col-lg-6">
                                 <label class="form-control-label" for="input-address">Warna</label>
                                 <input id="vehicle" type="text" class="form-control" placeholder="Type to Search Nopol (ex: B1234ABC)" value="{{$service->kendaraan->warna}}" readonly>
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
			               <h4 class="mb-0">Ini adalah form terbaru, jika ingin melihat versi lama <a href="{{ route('request.olddetail', $service->no_service) }}">klik disini</a></h4>
                        <!-- <a href="#" data-toggle="modal" data-target="#exampleModal2" class="btn btn-sm btn-info" style="background-color:#808080;">Tambah Service Non KHS</a> -->
                        <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-info" style="background-color:#808080;">Tambah Service</a>
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
                     <h3 class="mb-0">Bukti Sebelum Service</h3>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <div class="dropzone dropzone-single" data-toggle="dropzone" data-dropzone-url="http://">
                  @if($service->status == 'Waiting')
                  <div class="fallback">
                     <div class="custom-file">
                        <input type="file" class="custom-file-input" id="uploadImg">
                        <label class="custom-file-label" for="dropzoneBasicUpload">Choose file</label>
                       
                     </div>
                  </div>
                  @endif
                  <div class="dz-preview dz-preview-single mt-2">
                     <div class="dz-preview-cover">
                        @if($service->foto != NULL)
                        <img src="{{asset('bukti-service/'.$service->foto->foto_before)}}" class="dz-preview-img"  id="previewImg" style="height:250px; width:400px;" data-dz-thumbnail>
			               <a target="_blank" href="{{asset('bukti-service/'.$service->foto->foto_before)}}">Jika Foto tidak tampil, klik disini</a>
                        @else
                        <img class="dz-preview-img"  id="previewImg" style="height:250px; width:400px;" data-dz-thumbnail>
                        @endif
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   @if($service->status == 'On Warranty' || $service->status == 'Done')
   <div class="row mt-2">
      <div class="col-xl-12">
         <div class="card">
            <div class="card-header">
               <div class="row align-items-center">
                  <div class="col-8">
                     <h3 class="mb-0">Bukti Setelah Service</h3>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <div class="dropzone dropzone-single" data-toggle="dropzone" data-dropzone-url="http://">
                  <div class="dz-preview dz-preview-single mt-2">
                     <div class="dz-preview-cover">
                        @if($service->foto != NULL)
                        <img src="{{asset('bukti-service/'.$service->foto->foto_after)}}" class="dz-preview-img"  id="previewImg" style="height:250px; width:400px;" data-dz-thumbnail>
                        <a target="_blank" href="{{asset('bukti-service/'.$service->foto->foto_after)}}">Jika Foto tidak tampil, klik disini</a>
                        @else
                        <img class="dz-preview-img"  id="previewImg" style="height:250px; width:400px;" data-dz-thumbnail>
                        @endif
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   @endif
   <div class="row mt-4">
      <div class="col-12">
         <div class="float-right">
	         @if(Auth::user()->isDispatcher())
            @if($service->status == 'Waiting' || $service->status == 'On Service')
            <button type="submit" class="btn btn-primary">SUBMIT</button>
            @endif
            @endif
         </div>
         </form>
      </div>
   </div>
   @include('layouts.footers.auth')
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