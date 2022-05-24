@extends('layouts.app')
@section('content')
@include('sweetalert::alert')
@include('layouts.headers.requestService')
<div class="container-fluid mt--7">
   <div class="row">
      <div class="col-xl-12">
         <div class="card">
            <div class="card-header">
               <div class="row align-items-center">
                  <div class="col-8">
                     <h3 class="mb-0">Input Nopol </h3>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <form  action="{{ route('store.service') }}" method="POST" enctype="multipart/form-data">
                @csrf
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <label class="form-control-label" for="input-address">Nopol*</label>
                           <input id="vehicle" name="nopol" class="form-control" placeholder="Type to Search Nopol (ex: B1234ABC)" list="datalistOptions">
                           <datalist id="datalistOptions">
                                @foreach($kendaraan as $k)
                                <option name="nopol" value="{{$k->nopol}}">{{$k->nopol}}</option>
                                @endforeach
                           </datalist>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                      <div class="col-5"></div>
                      <div class="col-2">
                            <button type="submit" style="color:white; text-align:center;background-color:#808080;"  class="btn btn-md btn-primary">INPUT NOPOL</button>
                      </div>
                      <div class="col-5"></div>
                  </div>
               </form>
            </div>
         </div>
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