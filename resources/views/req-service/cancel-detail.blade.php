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
               <form action="{{ route('cancel.process', $service->no_service) }}" method="get" enctype="multipart/form-data">
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
                  <div class="col-8">
                     <h3 class="mb-0">Pilihan Service </h3>
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
                        @foreach($service->rincian as $r)
                        <tr class="text-center">
                           @if($service->status == 'Waiting')
                           <th width="5%"><a href="{{route('delete.rincian', $r->id)}}" onclick="return confirm('YAKIN HAPUS RINCIAN SERVICE?')" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a></th>
                           @else
                           <th width="5%">-</th>
                           @endif   
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
                           <th>{{number_format($service->subtotal)}}</th>
                        </tr>
                        <tr class="teal darken-1 white-text text-center" style="color:white;font-weight:bolder;background-color:#808080">
                           <th colspan="4">PPn(10%)</th>
                           <th>{{number_format($service->ppn)}}</th>
                        </tr>
                        <tr class="teal darken-1 white-text text-center" style="color:white;font-weight:bolder;background-color:#808080">
                           <th colspan="4">Grand Total</th>
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
   <div class="col-xl-6">
         <div class="card">
            <div class="card-header">
               <div class="row align-items-center">
                  <div class="col-8">
                     <h3 class="mb-0">Informasi Bengkel </h3>
                  </div>
               </div>
            </div>
            <div class="card-body">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-control-label" for="input-address">Jenis Bengkel</label>
                            <input id="vehicle" name="selectBengkel" type="text" class="form-control" placeholder="Type to Search Nopol (ex: B1234ABC)" value="{{$service->jenis_bengkel}}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="input-address">Nama Bengkel</label>
                            <input id="vehicle" name="bengkel" type="text" class="form-control" placeholder="Type to Search Nopol (ex: B1234ABC)" value="{{$service->bengkel}}" readonly>
                        </div>
                     </div>
                  </div>
            </div>
         </div>
      </div>
      <div class="col-xl-6">
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
      <div class="col-xl-6">
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
                        <img src="{{asset('bukti-service/'.$service->foto->foto_before)}}" class="dz-preview-img"  id="previewImg" style="height:250px; width:400px;" data-dz-thumbnail>
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
            <button type="submit" class="btn btn-md btn-danger">Cancel Service</button>
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