<div class="header pb-8 pt-5 pt-md-8" style="background-color:#ed1c24;">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Invoice</h6>
                </div>
                <div class="col-lg-6 col-7">
                    <div class="float-sm-right">
                        <form action="#" method="GET" class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
                            <div class="form-group mb-0">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    </div>
                                    <input class="form-control" name="search" placeholder="Search" type="text">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @if(Auth::user()->isPusat())
            <form action="{{route('search.invoice')}}" method="GET" enctype="multipart/form-data">
                <div class="row align-items-center d-flex mb--2">
                    <div class="col-lg-3">
                        
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <div class="form-control-label" style="color:white;">Area</div>
                            <select class="form-control" name="area">
                                <option value="" @if($areanya == NULL) selected disabled @endif>Pilih Salah Satu</option>
                                @foreach($area as $a)
                                <option value="{{$a->kode_area}}" @if($areanya == $a->kode_area) selected @endif>{{$a->nama_area}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <br>
                            <button type="submit" class="btn btn-md btn-white btn-block">Search</button>
                        </div>
                    </div>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>