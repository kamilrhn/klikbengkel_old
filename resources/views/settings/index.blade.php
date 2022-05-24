@extends('layouts.app')
@section('content')
@include('layouts.headers.settings')
<div class="container-fluid mt--7">
   <div class="row">
      <div class="col">
         <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Konfigurasi Validasi</h3>
            </div>
            <!-- Light table -->
            <div class="card-body">
                @if($area->setting == null)
                <form action="{{route('setting.create')}}" method="post" enctype="multipart/form-data">
                @else
                <form action="#" method="get" enctype="multipart/form-data">
                @endif
                @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <label class="form-control-label" for="input-address">Selisih Odometer</label>
                            @if($area->setting != null)
                            <input id="vehicle" type="number" name="km" class="form-control" placeholder="Selisih Odometer" value="{{$setting->km}}" >
                            @else
                            <input id="vehicle" name="km" type="number" class="form-control" placeholder="Selisih Odoometer" value="" >
                            @endif
                        </div>
                        <div class="col-lg-6">
                            <label class="form-control-label" for="input-address">Selisih Bulan</label>
                            @if($area->setting != null)
                            <input id="vehicle" name="waktu" type="number" class="form-control" placeholder="Selisih Bulan" value="{{$setting->waktu}}" >
                            @else
                            <input id="vehicle" name="waktu" type="number" class="form-control" placeholder="Selisih Bulan" value="" >
                            @endif
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="float-sm-right">
                                <button type="submit" class="btn btn-primary">SUBMIT</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
          </div>
      </div>
   </div>
   @include('layouts.footers.auth')
</div>
@endsection