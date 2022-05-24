<div class="header pb-8 pt-5 pt-md-8" style="background-color:#ed1c24;">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row align-items-center ">
                <div class="col-lg-6 col-7">
                    @if(Auth::user()->isPusat())
                    <h6 class="h2 text-white d-inline-block mb-0">DASHBOARD KBM AREA {{ request()->segment(count(request()->segments())) }}</h6>
                    @elseif(Auth::user()->isAsman())
                    <h6 class="h2 text-white d-inline-block mb-4">DASHBOARD KBM AREA {{ Auth::user()->resp }} </h6>
                    @else
                    <h6 class="h2 text-white d-inline-block mb-4">DASHBOARD KBM {{ Auth::user()->resp }} </h6>
                    @endif
                </div>
                <div class="col-lg-3 col 7">
                    @if(Auth::user()->isPusat() || Auth::user()->isAdmin())
                    <div class="form-group">
                        <label for="" class="form-control-label text-white">Pilih Area</label>
                        <select name="" id="" class="form-control" onchange="location = this.value">
                            <option value="#" selected disabled>Pilih Area</option>
                            <option value="{{route('home')}}"   >All</option>
                            <option value="{{route('home.area', 1)}}"   >Area 1</option>
                            <option value="{{route('home.area', 2)}}"   >Area 2</option>
                            <option value="{{route('home.area', 3)}}"   >Area 3</option>
                            <option value="{{route('home.area', 4)}}"   >Area 4</option>
                            <option value="{{route('home.area', 5)}}"   >Area 5</option>
                            <option value="{{route('home.area', 6)}}"   >Area 6</option>
                            <option value="{{route('home.area', 7)}}"   >Area 7</option>
                        </select>
                    </div>
                    @endif
                </div>
                <div class="col-lg-3 col 7">
                    @if(Auth::user()->isPusat() || Auth::user()->isAdmin())
                    <div class="form-group">
                        <label for="" class="form-control-label text-white">Pilih Periode</label>
                        <select name="" id="" class="form-control" onchange="location = this.value">
                            <option value="#" selected disabled>Pilih Periode</option>
                            <option value="#">All</option>
                            <option value="#"   >Januari</option>
                            <option value="#"   >Februari</option>
                            <option value="#"   >Maret</option>
                            <option value="#"   >April</option>
                            <option value="#"   >Mei</option>
                            <option value="#"   >Juni</option>
                            <option value="#"   >Juli</option>
                            <option value="#"   >Agustus</option>
                            <option value="#"   >September</option>
                            <option value="#"   >Oktober</option>
                            <option value="#"   >November</option>
                            <option value="#"   >Desember</option>
                        </select>
                    </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Jumlah Kendaraan</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$kendaraan}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="fas fa-car"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                <span class="text-nowrap">Since last month</span>
                            </p> -->
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total SPS</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$totalsps}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                        <i class="fas fa-car-crash"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 3.48%</span>
                                <span class="text-nowrap">Since last week</span>
                            </p> -->
                        </div>
                    </div>
                </div>
               
                <div class="col-xl-4 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">SPS Done</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$spsdone}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                                <span class="text-nowrap">Since last month</span>
                            </p> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row align-right mb--5">
                <div class="col-lg-12 col 7">
                    <form action="{{route('part.search')}}" method="get" enctype="multipart/form-data">
                        @csrf
                         <div class="row">
                             <div class="col-9">
                                 <div class="form-group">
                                     <label class="form-control-label text-white" for="input-city">Pilih Service</label>
                                     <select name="search" class="form-control">
                                         <option value="" selected disabled>Pilih Service</option> 
                                         @foreach($rincian as $r)
                                             <option value="{{$r->keterangan}}">{{$r->keterangan}}</option> 
                                         @endforeach
                                     </select>
                                 </div>
                             </div>
                             <div class="col-3">
                                 <div class="form-group">
                                     <br>
                                 <button type="submit" class="btn btn-md btn-primary btn-block" style="background-color:#808080;">Search</button>
                                 </div>
                             </div>
                         </div>
                    </form>
                 </div>
            </div>
        </div>
    </div>
</div>